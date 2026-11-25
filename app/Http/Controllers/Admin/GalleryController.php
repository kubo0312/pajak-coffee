<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.form', [
            'item' => new GalleryItem(['sort_order' => 0]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if (! $request->hasFile('photo')) {
            return back()
                ->withInput()
                ->withErrors(['photo' => 'Pilih foto dulu (JPG/PNG/WebP, maks 2 MB).']);
        }

        $nama = Str::random(8).'.'.$request->file('photo')->extension();
        $request->file('photo')->move(public_path('uploads'), $nama);

        GalleryItem::create([
            'image' => 'uploads/'.$nama,
            'caption' => $data['caption'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.gallery')->with('status', 'Foto ditambahkan ke galeri.');
    }

    public function edit(GalleryItem $item)
    {
        return view('admin.gallery.form', ['item' => $item]);
    }

    public function update(Request $request, GalleryItem $item)
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($data['photo']);

        if ($request->hasFile('photo')) {
            if ($item->image && str_starts_with($item->image, 'uploads/')) {
                @unlink(public_path($item->image));
            }
            $nama = Str::random(8).'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('uploads'), $nama);
            $data['image'] = 'uploads/'.$nama;
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $item->update($data);

        return redirect()->route('admin.gallery')->with('status', 'Foto galeri diperbarui.');
    }

    public function destroy(GalleryItem $item)
    {
        if ($item->image && str_starts_with($item->image, 'uploads/')) {
            @unlink(public_path($item->image));
        }
        $item->delete();

        return redirect()->route('admin.gallery')->with('status', 'Foto dihapus dari galeri.');
    }
}
