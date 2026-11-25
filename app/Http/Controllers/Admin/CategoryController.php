<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:40', Rule::unique('categories', 'name')],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Category::create($data);

        return redirect()->route('admin.categories')->with('status', 'Kategori ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.form', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:40', Rule::unique('categories', 'name')->ignore($category)],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

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

    private function uniqueSlug($name)
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
