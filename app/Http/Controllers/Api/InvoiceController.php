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
}
