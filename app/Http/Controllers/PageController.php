<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'featured' => Menu::with('category')->where('is_available', true)->orderBy('sort_order')->limit(3)->get(),
            'menuCount' => Menu::where('is_available', true)->count(),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function menu(Request $request)
    {
        $categories = Category::orderBy('sort_order')->get();
        $active = $categories->firstWhere('slug', $request->query('kategori'));

        $menus = Menu::with('category')
            ->where('is_available', true)
            ->when($active, fn ($q) => $q->where('category_id', $active->id))
            ->orderBy('sort_order')
            ->get();

        return view('pages.menu', [
            'categories' => $categories,
            'activeCategory' => $active,
            'menus' => $menus,
        ]);
    }

    public function gallery()
    {
        return view('pages.gallery', [
            'items' => GalleryItem::orderBy('sort_order')->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
