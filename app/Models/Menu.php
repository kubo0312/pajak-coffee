<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'price', 'description',
        'image', 'is_available', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
