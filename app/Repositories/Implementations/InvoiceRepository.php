<?php

namespace App\Repositories\Implementations;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Gate;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index(): array
    {
        return Invoice::where('user_id', auth()->user()->id)
            ->get()
            ->toArray();
    }

    public function show(string $id): Invoice
    {
        $invoice = Invoice::with('purchases')->find($id);

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
}
