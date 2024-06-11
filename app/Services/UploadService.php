<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UploadRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class UploadService
{
    private $uploadRepository;
    public function __construct(
        UploadRepositoryInterface $uploadRepository
    ) {
        $this->uploadRepository = $uploadRepository;
    }
    public function store(UploadedFile $file): void
    {
        $this->uploadRepository->store($file->getRealPath());
    }
}