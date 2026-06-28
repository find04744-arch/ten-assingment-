<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prompt_id',
        'reason',
        'description',
        'status',
    ];

    protected $casts = [
        'reason' => 'array',
    ];

    /**
     * Get the user that submitted the report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reported prompt.
     */
    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }
}
