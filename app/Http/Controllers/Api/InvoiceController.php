<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;

/**
 * @OA\Tag(name="Invoice")
 */
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

    /**
     * @OA\Get(
     *  path="/api/invoices/{id}",
     *  tags={"Invoice"},
     *  summary="Get an invoice",
     *  security={{"bearerAuth":{}}},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Invoice ID",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          @OA\Property(property="data", type="object",
     *              @OA\Property(property="invoice", type="object",
     *                  @OA\Property(property="id", type="string", example=2),
     *                  @OA\Property(property="date", type="string", example="2022-06-28"),
     *                  @OA\Property(property="total", type="string", example=100)
     *               ),
     *              @OA\Property(property="purchases", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="date", type="string", example="2022-06-28"),
     *                      @OA\Property(property="items", type="array",
     *                          @OA\Items(type="object",
     *                              @OA\Property(property="id", type="string", example=1),
     *                              @OA\Property(property="title", type="string", example="Compra no ifood"),
     *                              @OA\Property(property="value", type="string", example=90.90),
     *                              @OA\Property(property="type", type="string", example="food")
     *                          )
     *                      )
     *                   )
     *                )
     *           )
     *      )
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="Unauthorized",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Unauthenticated."),
     *      ),
     *  ),
     *  @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *      ),
     *  ),
     *)
     **/
    function show(string $id)
    {
        return $this->invoiceService->show($id);
    }

    /**
     * @OA\Get(
     *      tags={"Invoice"},
     *      security={{"bearerAuth":{}}},
     *      path="/api/invoices/{id}/chart",
     *      summary="Get the invoice chart",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Invoice ID",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(type="object",
     *                  @OA\Property(property="type", type="string", example="food"),
     *                  @OA\Property(property="value", type="string", example=100)
     *                 ),
     *              ),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated."),
     *          ),
     *      ),
     * )
     *
     **/
    public function chart(string $id)
    {
        return $this->invoiceService->chart($id);
    }

    /**
     * @OA\Get(
     *      tags={"Invoice"},
     *      security={{"bearerAuth":{}}},
     *      path="/api/invoices/current-invoice",
     *      summary="Get the current invoice",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="invoice", type="object",
     *                      @OA\Property(property="id", type="string", example=2),
     *                      @OA\Property(property="date", type="string", example="2022-06-28"),
     *                      @OA\Property(property="total", type="string", example=100)
     *                  ),
     *                  @OA\Property(property="purchases", type="array",
     *                      @OA\Items(type="object",
     *                          @OA\Property(property="date", type="string", example="2022-06-28"),
     *                          @OA\Property(property="items", type="array",
     *                              @OA\Items(type="object",
     *                                  @OA\Property(property="id", type="string", example=1),
     *                                  @OA\Property(property="title", type="string", example="Compra no ifood"),
     *                                  @OA\Property(property="value", type="string", example=90.90),
     *                                  @OA\Property(property="type", type="string", example="food")
     *                              )
     *                          )
     *                      )
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated."),
     *          ),
     *      ),
     * )
     **/
    public function currentInvoice()
    {
        return $this->invoiceService->currentInvoice();
    }

    /**
     *  @OA\Get(
     *      tags={"Invoice"},
     *      security={{"bearerAuth":{}}},
     *      path="/api/invoices/next-invoices",
     *      summary="Get the next invoices",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="total", type="string", example=100),
     *                  @OA\Property(property="invoices", type="array",
     *                      @OA\Items(type="object",
     *                          @OA\Property(property="id", type="string", example=1),
     *                          @OA\Property(property="date", type="string", example="2022-06-28"),
     *                          @OA\Property(property="total", type="string", example=100)
     *                      )
     *                  )
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated."),
     *          ),
     *      ),
     * )
     **/
    public function nextInvoices()
    {
        return $this->invoiceService->nextInvoices();
    }
}
