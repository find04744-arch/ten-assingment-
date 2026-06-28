<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'category',
        'ai_tool',
        'tags',
        'difficulty_level',
        'thumbnail_image',
        'visibility',
        'copy_count',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'tags' => 'array',
        'copy_count' => 'integer',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user that owns the prompt.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reviews for the prompt.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the bookmarks for the prompt.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Get the reports for the prompt.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get average rating of the prompt.
     */
    public function averageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get bookmark count.
     */
    public function bookmarkCount(): int
    {
        return $this->bookmarks()->count();
    }

    /**
     * Scope to get only approved prompts.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get only pending prompts.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get only rejected prompts.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope to get only public prompts.
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    /**
     * Scope to get featured prompts.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
