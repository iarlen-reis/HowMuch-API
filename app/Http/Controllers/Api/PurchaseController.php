<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;

/**
 * @OA\Tag(name="Purchase")
 */
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

    /**
     * @OA\Get(
     *     tags={"Purchase"},
     *     path="/api/purchase/{id}",
     *     summary="Get a purchase by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Purchase ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="string", example=1),
     *                 @OA\Property(property="title", type="string", example="Compra no ifood"),
     *                 @OA\Property(property="value", type="string", example=90.90),
     *                 @OA\Property(property="type", type="string", example="food"),
     *                 @OA\Property(property="date", type="string", example="2022-06-28"),
     *                 @OA\Property(property="description", type="string", example="Comprei no ifood"),
     *                 @OA\Property(property="invoice_id", type="string", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated."),
     *         )
     *     ),
     * ),
     * )
     */
    public function show(string $id)
    {
        return $this->purchaseService->show($id);
    }

    /**
     * @OA\Post(
     *     tags={"Purchase"},
     *     path="/api/purchase",
     *     summary="Create a purchase",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Compra no ifood"),
     *             @OA\Property(property="value", type="string", example=90.90),
     *             @OA\Property(property="type", type="string", example="food"),
     *             @OA\Property(property="date", type="string", example="2022-06-28"),
     *             @OA\Property(property="description", type="string", example="Comprei no ifood")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="string", example=1),
     *                 @OA\Property(property="title", type="string", example="Compra no ifood"),
     *                 @OA\Property(property="value", type="string", example=90.90),
     *                 @OA\Property(property="type", type="string", example="food"),
     *                 @OA\Property(property="date", type="string", example="2022-06-28"),
     *                 @OA\Property(property="description", type="string", example="Comprei no ifood"),
     *                 @OA\Property(property="invoice_id", type="string", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated."),
     *         )
     *     ),
     * ),
     */
    public function store(PurchaseRequest $request)
    {
        return $this->purchaseService->store($request->all());
    }

    /**
     * @OA\Delete(
     *     tags={"Purchase"},
     *     path="/api/purchase/{id}",
     *     summary="Delete a purchase by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Purchase ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated."),
     *         )
     *     ),
     * ),
     */
    public function destroy(string $id)
    {
        return $this->purchaseService->destroy($id);
    }


    /**
     * @OA\Get(
     *     tags={"Purchase"},
     *     path="/api/purchase/last-purchases",
     *     summary="Get the last purchases",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="total_current_invoice", type="string", example=100),
     *                 @OA\Property(property="total_next_invoices", type="string", example=100),
     *                 @OA\Property(property="last_purchases", type="array",
     *                     @OA\Items(type="object",
     *                         @OA\Property(property="date", type="string", example="2022-06-28"),
     *                         @OA\Property(property="items", type="array",
     *                             @OA\Items(type="object",
     *                                 @OA\Property(property="id", type="string", example=1),
     *                                 @OA\Property(property="title", type="string", example="Compra no ifood"),
     *                                 @OA\Property(property="value", type="string", example=90.90),
     *                                 @OA\Property(property="type", type="string", example="food")
     *                             )
     *                         )
     *                     )
     *                 )
     *              ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated."),
     *         )
     *     ),
     * ),
     */
    public function lastPurchases()
    {
        return $this->purchaseService->lastPurchases();
    }
}
