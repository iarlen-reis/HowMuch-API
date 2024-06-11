<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthRepositoryInterface
{
    public function login(array $credentials): bool | string;

    public function userExists(string $email): bool;

    public function register(array $data): User;

    public function me(): Authenticatable;

    public function logout(): void;
}