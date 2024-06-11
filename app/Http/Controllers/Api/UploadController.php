<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private $uploadService;
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
    public function store(Request $request)
    {
        $this->uploadService->store($request->file('file'));
    }
}