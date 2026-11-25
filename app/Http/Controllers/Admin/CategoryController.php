<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::withCount('menus')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.category.form', [
            'category' => new Category(['sort_order' => 0]),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Category::create($data);

        return redirect()->route('admin.categories')->with('status', 'Kategori ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.form', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // slug dibiarkan, supaya URL /menu?kategori=... tidak patah
        $category->update($data);

        return redirect()->route('admin.categories')->with('status', 'Kategori diperbarui.');
    }

    public function destroy(Category $category)
    {
        if ($category->menus()->exists()) {
            return back()->with('error', 'Kategori "'.$category->name.'" masih dipakai menu. Pindahkan menunya dulu.');
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('status', 'Kategori dihapus.');
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'kategori';
        $slug = $base;
        $i = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}