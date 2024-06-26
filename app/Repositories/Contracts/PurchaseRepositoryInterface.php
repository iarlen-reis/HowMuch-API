<?php

namespace App\Repositories\Contracts;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Collection;

interface PurchaseRepositoryInterface
{
    public function index(): Collection;

    public function show(string $id): Purchase;

    public function store(array $data): Purchase;

    public function destroy(string $id): void;

    public function lastPurchases(): Collection;
}