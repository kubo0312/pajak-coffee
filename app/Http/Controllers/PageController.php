<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Menu;
use App\Models\SiteProfile;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'profile' => SiteProfile::current(),
            'featured' => Menu::with('category')->available()->orderBy('sort_order')->limit(3)->get(),
            'menuCount' => Menu::available()->count(),
        ]);
    }

    public function about()
    {
        return view('pages.about', ['profile' => SiteProfile::current()]);
    }

    public function menu(\Illuminate\Http\Request $request)
    {
        $categories = Category::orderBy('sort_order')->get();
        $active = $categories->firstWhere('slug', $request->query('kategori'));

        $menus = Menu::with('category')
            ->available()
            ->when($active, fn ($q) => $q->where('category_id', $active->id))
            ->orderBy('sort_order')
            ->get();

        return view('pages.menu', [
            'profile' => SiteProfile::current(),
            'categories' => $categories,
            'activeCategory' => $active,
            'menus' => $menus,
        ]);
    }

    public function gallery()
    {
        return view('pages.gallery', [
            'profile' => SiteProfile::current(),
            'items' => GalleryItem::orderBy('sort_order')->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'profile' => SiteProfile::current(),
        ]);
    }
}