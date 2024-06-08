<?php

namespace App\Repositories\Contracts;

use App\Models\Invoice;
use DateTime;
use Illuminate\Http\JsonResponse;

interface InvoiceRepositoryInterface
{
    public function index(): array;

    public function show(string $id): Invoice;

    public function store(DateTime $date): Invoice;

    public function existByMonthAndYear(string $date): Invoice;
}
