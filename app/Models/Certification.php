<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'issued_by', 'issued_at'];

    protected $casts = ['issued_at' => 'date'];
}
