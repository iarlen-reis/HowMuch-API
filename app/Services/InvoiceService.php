<?php

namespace App\Services;

use App\Http\Resources\Invoice\InvoiceResource;
use App\Http\Resources\Invoice\NextInvoiceResource;
use App\Http\Resources\Invoice\ShowInvoiceResource;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceService
{
    private $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        return InvoiceResource::collection($this->invoiceRepository->index());
    }

    public function show(string $id): ShowInvoiceResource
    {
        $purchases = $this->invoiceRepository->grouped($id);

        $result = $purchases->map(function ($group, $date) {
            return [
                'date' => $date,
                'items' => $group->map(function ($purchase) {
                    return [
                        'id' => $purchase->id,
                        'title' => $purchase->title,
                        'value' => $purchase->value,
                        'type' => $purchase->type,
                    ];
                })->all(),
            ];
        })->values()->all();

        return ShowInvoiceResource::make([
            'invoice' => $this->invoiceRepository->show($id),
            'purchases' => $result,
        ]);
    }

    public function store(DateTime $date): JsonResponse
    {
        $invoice = $this->invoiceRepository->store($date);

        return response()->json($invoice);
    }

    public function grouped(string $id)
    {
        $purchases = $this->invoiceRepository->grouped($id);

        $result = $purchases->map(function ($group, $date) {
            return [
                'date' => $date,
                'items' => $group->map(function ($purchase) {
                    return [
                        'id' => $purchase->id,
                        'title' => $purchase->title,
                        'value' => $purchase->value,
                        'type' => $purchase->type,
                    ];
                })->all(),
            ];
        })->values()->all();

        return $result;
    }

    public function totalNextInvoices()
    {
        return response()->json([
            'total' => $this->invoiceRepository->totalNextInvoices(),
        ]);
    }

    public function totalCurrentInvoice()
    {
        return response()->json([
            'total' => $this->invoiceRepository->totalCurrentInvoice(),
        ]);
    }

    public function chart(string $id)
    {
        $invoice = $this->invoiceRepository->chart($id);

        if (!$invoice) {
            return response()->json(["message" => "Invoice not found"], 404);
        }

        $chart = $invoice->map(function ($group, $type) {
            $totalValue = $group->sum('value');

            return [
                'type' => $type,
                'total_value' => $totalValue,
            ];
        })->values()->all();

        return response()->json($chart);
    }

    public function currentInvoice()
    {
        $invoice = $this->invoiceRepository->currentInvoice();

        $puchases = $this->invoiceRepository->grouped($invoice->id);

        $result = $puchases->map(function ($group, $date) {
            return [
                'date' => $date,
                'items' => $group->map(function ($purchase) {
                    return [
                        'id' => $purchase->id,
                        'title' => $purchase->title,
                        'value' => $purchase->value,
                        'type' => $purchase->type,
                    ];
                })->all(),
            ];
        })->values()->all();

        return ShowInvoiceResource::make([
            'invoice' => $invoice,
            'purchases' => $result,
        ]);
    }

    public function nextInvoices(): NextInvoiceResource
    {
        return NextInvoiceResource::make([
            'total' => $this->invoiceRepository->totalNextInvoices(),
            'invoices' => $this->invoiceRepository->nextInvoices(),
        ]);
    }
}
