<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand_mark', 'tagline', 'hero_title', 'hero_lead',
        'about', 'vision', 'mission', 'address', 'hours',
        'phone', 'whatsapp', 'instagram', 'map_query',
    ];

    protected $casts = [
        'mission' => 'array',
        'hours' => 'array',
    ];

    /** Selalu ambil baris pertama; kalau kosong, buat default supaya view tidak pecah. */
    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'name' => 'Pajak Coffee',
            'brand_mark' => 'PC',
            'tagline' => 'Kedai kopi di Dumai Kota',
            'hero_title' => 'Kopi yang menemani malam di Dumai.',
            'address' => 'Jl. Sultan Hasanuddin, Rimba Sekampung, Dumai Kota',
            'hours' => [],
            'mission' => [],
        ]);
    }
}