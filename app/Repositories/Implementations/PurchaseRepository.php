<?php

namespace App\Repositories\Implementations;

use App\Models\Purchase;
use App\Repositories\Contracts\PurchaseRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PurchaseRepository implements PurchaseRepositoryInterface
{

    public function index(): array
    {
        return Purchase::where('user_id', auth()->id())->get()->toArray();
    }

    public function show(string $id): Purchase
    {
        return Purchase::findOrFail($id);
    }

    public function store(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function destroy(string $id): void
    {
        Purchase::findOrFail($id)->delete();
    }

    public function lastPurchases(): Collection
    {
        $purchases = Purchase::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->take(6)
            ->get()
            ->groupBy(function ($purchase) {
                return Carbon::parse($purchase->date)->format('Y-m-d');
            });

        return $purchases;
    }
}
