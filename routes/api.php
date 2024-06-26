<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\UploadController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/auth"], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => '/auth', 'middleware' => ['auth:api']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => '/invoices', 'middleware' => ['auth:api']], function () {
    Route::get('/current-invoice', [InvoiceController::class, 'currentInvoice']);
    Route::get('/next-invoices', [InvoiceController::class, 'nextInvoices']);
    Route::get('/', [InvoiceController::class, 'index']);
    Route::get('/{id}', [InvoiceController::class, 'show']);
    Route::get('/{id}/chart', [InvoiceController::class, 'chart']);
});


Route::group(['prefix' => '/purchase', 'middleware' => ['auth:api']], function () {
    Route::get('/last-purchases', [PurchaseController::class, 'lastPurchases']);
    Route::get('/', [PurchaseController::class, 'index']);
    Route::post('/', [PurchaseController::class, 'store']);
    Route::get('/{id}', [PurchaseController::class, 'show']);
    Route::delete('/{id}', [PurchaseController::class, 'destroy']);
});

Route::group(['prefix' => '/upload', 'middleware' => ['auth:api']], function () {
    Route::post('/', [UploadController::class, 'store']);
});
