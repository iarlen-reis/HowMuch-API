<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Contracts\UploadRepositoryInterface;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UploadRepository implements UploadRepositoryInterface
{
    public function store(string $realPath): void
    {
        $url = Cloudinary::upload($realPath, [
            'folder' => 'how-much',
        ])->getSecurePath();

        User::where('id', auth()->id())->update(['photo' => $url]);
    }
}