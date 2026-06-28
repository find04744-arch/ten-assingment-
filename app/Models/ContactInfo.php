<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';

    protected $fillable = [
        'phone',
        'email',
        'address',
        'map_embed',
        'form_title',
        'form_description',
        'twitter_url',
        'facebook_url',
        'contact_section_title',
        'contact_section_heading',
        'contact_section_description',
        'head_office_title',
        'branch_office_title',
        'branch_office_address',
        'branch_office_phone',
        'branch_office_email',
    ];
}
