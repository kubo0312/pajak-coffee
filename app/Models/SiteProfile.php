<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteProfile extends Model
{
    protected $fillable = [
        'name', 'brand_mark', 'tagline', 'hero_title', 'hero_lead',
        'about', 'vision', 'mission', 'address', 'hours',
        'phone', 'whatsapp', 'instagram', 'map_query',
    ];

    protected $casts = [
        'mission' => 'array',
        'hours' => 'array',
    ];
}
