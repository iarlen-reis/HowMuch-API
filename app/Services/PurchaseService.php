<?php

namespace App\Services;

use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\PurchaseRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class PurchaseService
{
    private $purchaseRepository;
    private $invoiceRepository;
    public function __construct(
        PurchaseRepositoryInterface $purchaseRepository,
        InvoiceRepositoryInterface $invoiceRepository
    ) {
        $this->purchaseRepository = $purchaseRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        return response()->json($this->purchaseRepository->index());
    }

    public function show(string $id)
    {
        $purchase = $this->purchaseRepository->show($id);

        Gate::authorize('show', $purchase);

        return response()->json($purchase);
    }

    public function store(array $data)
    {
        $invoiceExist = $this->invoiceRepository->existByMonthAndYear($data['date']);

        $purchase = $this->purchaseRepository->store([
            ...$data,
            'invoice_id' => $invoiceExist->id,
            'user_id' => auth()->user()->id,
        ]);

        $invoiceExist->update([
            'total' => $invoiceExist->total + $data['value'],
        ]);

        return response()->json([
            'purchase' => $purchase,
        ]);
    }

    public function destroy(string $id)
    {
        $purchase = $this->purchaseRepository->show($id);

        Gate::authorize('destroy', $purchase);

        $invoice = $this->invoiceRepository->show($purchase->invoice_id);

        $invoice->update([
            'total' => $invoice->total -= $purchase->value,
        ]);

        $this->purchaseRepository->destroy($purchase->id);
    }

    public function lastPurchases()
    {
        $purchases = $this->purchaseRepository->lastPurchases();

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

        return response()->json([
            'total_current_invoice' => $this->invoiceRepository->totalCurrentInvoice(),
            'total_next_invoices' => $this->invoiceRepository->totalNextInvoices(),
            'last_purchases' => $result,
        ]);
    }
}
