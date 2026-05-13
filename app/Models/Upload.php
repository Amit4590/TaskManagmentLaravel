<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'user_id',
        'file'
    ];

    protected $appends = [
        'file_url'
    ];

    public function getFileUrlAttribute(): string
    {
        return asset(
            'storage/' . $this->file
        );
    }
}
