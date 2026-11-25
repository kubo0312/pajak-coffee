<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Support\ImageUpload;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menu.index', [
            'menus' => Menu::with('category')->orderBy('category_id')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.menu.form', [
            'menu' => new Menu(['is_available' => true, 'sort_order' => 0]),
            'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    public function store(MenuRequest $request)
    {
        Menu::create($this->payload($request));

        return redirect()->route('admin.menu.index')->with('status', 'Menu baru ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.form', [
            'menu' => $menu,
            'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($this->payload($request, $menu));

        return redirect()->route('admin.menu.index')->with('status', 'Menu diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        ImageUpload::delete($menu->image);
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('status', 'Menu dihapus.');
    }

    private function payload(MenuRequest $request, ?Menu $menu = null): array
    {
        $data = $request->validated();
        unset($data['photo']);

        $data['is_available'] = $request->boolean('is_available');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // foto baru menang atas path manual
        if ($path = ImageUpload::store($request->file('photo'))) {
            if ($menu) {
                ImageUpload::delete($menu->image);
            }
            $data['image'] = $path;
        }

        // slug hanya dibuat sekali; biar URL/relasi tidak berubah saat nama diedit
        if (! $menu) {
            $data['slug'] = Str::slug($data['name']).'-'.Str::lower(Str::random(4));
        }

        return $data;
    }
}