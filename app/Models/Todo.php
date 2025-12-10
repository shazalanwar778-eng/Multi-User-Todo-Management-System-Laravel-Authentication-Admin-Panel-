<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'attachment',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the user that owns the todo.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get image URL.
     */
    public function getImageUrl(): string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Get attachment URL.
     */
    public function getAttachmentUrl(): string
    {
        return $this->attachment ? asset('storage/' . $this->attachment) : null;
    }

    /**
     * Check if todo is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Mark todo as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    /**
     * Mark todo as pending.
     */
    public function markAsPending(): void
    {
        $this->update(['status' => 'pending']);
    }
}
