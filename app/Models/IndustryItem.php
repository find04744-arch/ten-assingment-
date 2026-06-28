<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryItem extends Model
{
    protected $fillable = ['category', 'title', 'description', 'image_path'];

    public static function categories(): array
    {
        return ['apparels', 'design', 'dresses', 'washing_plant', 'togs'];
    }
}
