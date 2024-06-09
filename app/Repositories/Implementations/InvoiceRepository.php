<?php

namespace App\Repositories\Implementations;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index(): Collection
    {
        return Invoice::where('user_id', auth()->user()->id)
            ->get();
    }

    public function show(string $id): Invoice
    {
        $invoice = Invoice::find($id);

        Gate::authorize('show', $invoice);

        return $invoice;
    }

    public function store(DateTime $date): Invoice
    {
        return Invoice::create([
            'date' => $date,
            'total' => 0,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function existByMonthAndYear(string $date): Invoice
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;

        $invoice = Invoice::where('user_id', auth()->user()->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->first();

        if (!$invoice) {
            return $this->store(Carbon::parse($date));
        }

        return $invoice;
    }

    public function grouped(string $id): Collection
    {
        $purchases = Purchase::where('user_id', auth()->id())
            ->where('invoice_id', $id)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($purchase) {
                return Carbon::parse($purchase->date)->format('Y-m-d');
            });

        return $purchases;
    }

    public function totalCurrentInvoice(): string
    {
        return  Invoice::where('user_id', auth()->user()->id)
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('total');
    }


    public function totalNextInvoices(): string
    {
        $totalNextInvoices = Invoice::where('user_id', auth()->user()->id)
            ->where('date', '>', Carbon::now())
            ->get()
            ->sum('total');


        return $totalNextInvoices;
    }

    public function nextInvoices(): Collection
    {
        return Invoice::where('user_id', auth()->user()->id)
            ->where('date', '>', Carbon::now())
            ->orderBy('date', 'asc')
            ->get();
    }

    public function chart(string $id): Collection
    {
        $purchases = Purchase::where('user_id', auth()->id())
            ->where('invoice_id', $id)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($purchase) {
                return $purchase->type;
            });


        return $purchases;
    }
}
