<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerPost extends Model
{
    protected $fillable = ['title', 'category', 'type', 'experience', 'salary', 'description', 'location', 'deadline', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];
}
