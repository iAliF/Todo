<?php

namespace App\Models;

use App\Enums\TodoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'status'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function casts(): array
    {
        return [
            'status' => TodoStatus::class,
        ];
    }
}
