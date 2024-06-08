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
}
