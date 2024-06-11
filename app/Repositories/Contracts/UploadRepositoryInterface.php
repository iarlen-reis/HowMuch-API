<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\File;

interface UploadRepositoryInterface
{
    public function store(string $realPath): void;
}