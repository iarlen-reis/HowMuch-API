<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->only('email', 'password'));
    }

    public function register(RegisterRequest $request)
    {
        return $this
            ->authService
            ->register($request->only('name', 'email', 'password'));
    }

    public function me()
    {
        return $this->authService->me();
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
