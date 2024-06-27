<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

/**
 * @OA\Tag(name="Auth")
 */
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post (
     *  path="/api/auth/login",
     *  tags={"Auth"},
     *  summary="Get the authenticated user with JWT token",
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="User’s email",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      description="User’s password",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjEiLCJuYW1lIjoiYWRtaW4iLCJleHAiOjE2Mjc4NDY0ODEsImlhdCI6MTYyNzg0MDQ4MSwiaWF0IjoxNjI3ODAwNDgxLCJzdWIiOiIxIiwibmFtZSI6ImFkbWluIn0.0s9w-0-0-0-0"),
     *          @OA\Property(property="token_type", type="string", example="Bearer"),
     *          @OA\Property(property="expires_in", type="number", example=3600),
     *      ),
     *  ),
     *  @OA\Response(
     *     response=401,
     *     description="Invalid credentials",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Unauthenticated."),
     *     ),
     *  ),
     *),
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->only('email', 'password'));
    }


    /**
     * @OA\Post(
     *  tags={"Auth"},
     *  path="/api/auth/register",
     *  summary="Register a new user",
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="User’s name",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="User’s email",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      description="User’s password",
     *      required=true,
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Success",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="number", example=2),
     *          @OA\Property(property="name", type="string", example="User"),
     *          @OA\Property(property="email", type="string", example="user@test.com"),
     *          @OA\Property(property="updated_at", type="string", example="2022-06-28 06:06:17"),
     *          @OA\Property(property="created_at", type="string", example="2022-06-28 06:06:17"),
     *      ),
     *  ),
     *  @OA\Response(
     *      response=409,
     *      description="User already exists",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="User already exists"),
     *      ),
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Validation errors",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="the field name is required"),
     *          @OA\Property(property="errors", type="object",
     *              @OA\Property(property="name", type="array",
     *                  @OA\Items(type="string", example="the field name is required"),
     *                  ),
     *                  @OA\Property(property="email", type="array",
     *                      @OA\Items(type="string", example="the field email is required"),
     *                  ),
     *          ),
     *      )
     *  ),
     * )
     */
    public function register(RegisterRequest $request)
    {
        return $this
            ->authService
            ->register($request->only('name', 'email', 'password'));
    }

    /**
     * @OA\Get (
     *  path="/api/auth/me",
     *  tags={"Auth"},
     *  summary="Get the authenticated user with JWT token",
     *  security={{"bearerAuth":{}}},
     *  @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          @OA\Property(property="data", type="object",
     *              @OA\Property(property="user", type="object",
     *                  @OA\Property(property="id", type="number", example=2),
     *                  @OA\Property(property="name", type="string", example="User"),
     *                  @OA\Property(property="email", type="string", example="user@test.com"),
     *                  @OA\Property(property="email_verified_at", type="string", example=null),
     *                  @OA\Property(property="updated_at", type="string", example="2022-06-28 06:06:17"),
     *                  @OA\Property(property="created_at", type="string", example="2022-06-28 06:06:17"),
     *              ),
     *           ),
     *      )
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="Invalid token",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Unauthenticated."),
     *      ),
     *  ),
     * ),
     */
    public function me()
    {
        return $this->authService->me();
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
