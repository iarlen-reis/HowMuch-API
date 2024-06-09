<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    function index()
    {
        return $this->invoiceService->index();
    }

    function show(string $id)
    {
        return $this->invoiceService->show($id);
    }

    public function grouped(string $id)
    {
        return response()->json($this->invoiceService->grouped($id));
    }

    public function totalCurrentInvoice()
    {
        return $this->invoiceService->totalCurrentInvoice();
    }

    public function totalNextInvoices()
    {
        return $this->invoiceService->totalNextInvoices();
    }

    public function nextInvoices()
    {
        return $this->invoiceService->nextInvoices();
    }

    public function chart(string $id)
    {
        return $this->invoiceService->chart($id);
    }
}
