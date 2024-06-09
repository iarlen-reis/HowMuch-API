<?php

namespace App\Repositories\Contracts;

use App\Models\Invoice;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Type\Decimal;

interface InvoiceRepositoryInterface
{
    public function index(): array;

    public function show(string $id): Invoice;

    public function store(DateTime $date): Invoice;

    public function existByMonthAndYear(string $date): Invoice;

    public function totalNextInvoices(): string;

    public function totalCurrentInvoice(): string;

    public function nextInvoices(): Collection;

    public function grouped(string $id): Collection;

    public function chart(string $id): Collection;
}
