<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Services\FileUploadService;
use App\Http\Requests\UploadFileRequest;

class UploadController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService) {

    }

    public function store(UploadFileRequest $request) {
        foreach ($request->file('files') as $file) {
            $path = $this->fileUploadService->upload($file);
            Upload::create([
                'user_id'   => auth()->id(),
                'file'      => $path
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}