<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'intro_image_path',
        'experience_years',
        'experience_title',
        'intro_subtitle',
        'intro_title',
        'intro_description_1',
        'intro_description_2',
        'intro_features',
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'values_title',
        'values_description',
        'values_list',
        'team_members',
        'why_choose_subtitle',
        'why_choose_title',
        'why_choose_description',
        'why_choose_features',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',
    ];

    protected $casts = [
        'intro_features' => 'array',
        'values_list' => 'array',
        'team_members' => 'array',
        'why_choose_features' => 'array',
    ];
}
