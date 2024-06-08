<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;

class PurchaseController extends Controller
{
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        return $this->purchaseService->index();
    }

    public function show(string $id)
    {
        return $this->purchaseService->show($id);
    }

    public function store(PurchaseRequest $request)
    {
        return $this->purchaseService->store($request->all());
    }

    public function destroy(string $id)
    {
        return $this->purchaseService->destroy($id);
    }

    public function lastPurchases()
    {
        return $this->purchaseService->lastPurchases();
    }
}
