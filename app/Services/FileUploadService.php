<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload(
        UploadedFile $file
    ): string {

        return Storage::disk('public')
            ->putFile(
                'uploads',
                $file
            );
    }
}   