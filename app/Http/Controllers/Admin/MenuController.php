<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'integer', 'min:0', 'max:1000000'],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_available' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        unset($data['photo']);
        $data['is_available'] = $request->boolean('is_available');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['slug'] = Str::slug($data['name']).'-'.Str::lower(Str::random(4));

        if ($request->hasFile('photo')) {
            $nama = Str::random(8).'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('uploads'), $nama);
            $data['image'] = 'uploads/'.$nama;
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('status', 'Menu baru ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.form', [
            'menu' => $menu,
            'categories' => Category::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'integer', 'min:0', 'max:1000000'],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_available' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        unset($data['photo']);
        $data['is_available'] = $request->boolean('is_available');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('photo')) {
            if ($menu->image && str_starts_with($menu->image, 'uploads/')) {
                @unlink(public_path($menu->image));
            }
            $nama = Str::random(8).'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('uploads'), $nama);
            $data['image'] = 'uploads/'.$nama;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('status', 'Menu diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image && str_starts_with($menu->image, 'uploads/')) {
            @unlink(public_path($menu->image));
        }
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('status', 'Menu dihapus.');
    }
}
