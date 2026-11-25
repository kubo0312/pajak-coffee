<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'caption', 'sort_order'];

    public function getImageUrlAttribute(): string
    {
        return asset($this->image);
    }
}