<?php

namespace App\Http\Controllers;


/**
 * @OA\Info(
 * title="HowMuch API Documentation",
 * description="This is the API documentation for the HowMuch API.",
 * version="1.0.0",
 * )
 * @OA\SecurityScheme(
 * type="http",
 * securityScheme="bearerAuth",
 * scheme="bearer",
 * bearerFormat="JWT"
 * )
 */
abstract class Controller
{
    //
}
