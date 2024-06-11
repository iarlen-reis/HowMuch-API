<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $credentials): bool | string
    {
        return auth()->attempt($credentials);
    }

    public function register(array $data): User
    {
        return User::create($data);
    }

    public function userExists(string $email): bool
    {
        return User::where('email', $email)->exists();
    }

    public function me(): Authenticatable
    {
        return User::where('id', auth()->id())->first();
    }

    public function logout(): void
    {
        auth()->logout();
    }
}