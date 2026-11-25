<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'menuCount' => Menu::count(),
            'categoryCount' => Category::count(),
            'galleryCount' => GalleryItem::count(),
            'menus' => Menu::with('category')->orderBy('sort_order')->get(),
        ]);
    }
}