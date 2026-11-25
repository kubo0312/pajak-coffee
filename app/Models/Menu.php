<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'price', 'description',
        'image', 'is_available', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** "18000" -> "Rp18.000" */
    public function getPriceLabelAttribute(): string
    {
        return 'Rp'.number_format($this->price, 0, ',', '.');
    }

    /** "18000" -> "18.000" (dipakai di tabel admin tanpa prefix Rp) */
    public function getPricePlainAttribute(): string
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset($this->image) : asset('assets/espresso.jpg');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}