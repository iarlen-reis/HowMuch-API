<?php

namespace App\Services;

use App\Http\Resources\Auth\Show;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthService
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $credentials): JsonResponse
    {
        if (!$token = $this->authRepository->login($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(array $data): JsonResponse
    {
        if ($this->authRepository->userExists($data['email'])) {
            return response()->json(['message' => 'User already exists.'], 409);
        }

        $userCreated = $this->authRepository->register($data);

        return response()->json($userCreated, 201);
    }

    public function me(): Show
    {
        return Show::make($this->authRepository->me());
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}