<?php

namespace App\Repositories\Contracts;

use App\Models\Invoice;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceRepositoryInterface
{
    public function index(): array;

    public function show(string $id): Invoice;

    public function store(DateTime $date): Invoice;

    public function existByMonthAndYear(string $date): Invoice;

    public function totalNextInvoices(): int;

    public function totalCurrentInvoice(): int;

    public function grouped(string $id): Collection;
}
