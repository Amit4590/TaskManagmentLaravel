<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date'
    ];

    protected $casts = [
        'status'   => TaskStatusEnum::class,
        'due_date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwnedBy(
        Builder $query,
        int $userId
    ): Builder {
        return $query->where(
            'user_id',
            $userId
        );
    }

    public function scopeSearch(
        Builder $query,
        ?string $search
    ): Builder {
        return $query->when(
            $search,
            fn ($q) =>
                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )
        );
    }

    public function scopeFilterStatus(
        Builder $query,
        ?string $status
    ): Builder {

        return $query->when(
            $status,
            fn ($q) =>
                $q->where(
                    'status',
                    $status
                )
        );
    }
}


