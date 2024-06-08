<?php

namespace App\Repositories\Contracts;

use App\Models\Purchase;
use DateTime;

interface PurchaseRepositoryInterface
{
    public function index(): array;

    public function show(string $id): Purchase;

    public function store(array $data): Purchase;

    public function destroy(string $id): void;
}
