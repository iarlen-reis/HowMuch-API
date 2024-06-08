<?php

namespace App\Services;

use App\Repositories\Contracts\InvoiceRepositoryInterface;
use DateTime;
use Illuminate\Http\JsonResponse;

class InvoiceService
{
    private $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index(): array
    {
        return $this->invoiceRepository->index();
    }

    public function show(string $id): JsonResponse
    {
        return response()->json($this->invoiceRepository->show($id));
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
            'total_next_invoices' => $this->invoiceRepository->totalNextInvoices(),
        ]);
    }

    public function totalCurrentInvoice()
    {
        return response()->json([
            'total_current_invoice' => $this->invoiceRepository->totalCurrentInvoice(),
        ]);
    }
}
