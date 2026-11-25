<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryItemRequest;
use App\Models\GalleryItem;
use App\Support\ImageUpload;

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

    public function store(GalleryItemRequest $request)
    {
        $data = $request->validated();
        $path = ImageUpload::store($request->file('photo'));

        if (! $path) {
            return back()
                ->withInput()
                ->withErrors(['photo' => 'Pilih foto dulu (JPG/PNG/WebP, maks 2 MB).']);
        }

        GalleryItem::create([
            'image' => $path,
            'caption' => $data['caption'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.gallery')->with('status', 'Foto ditambahkan ke galeri.');
    }

    public function edit(GalleryItem $item)
    {
        return view('admin.gallery.form', ['item' => $item]);
    }

    public function update(GalleryItemRequest $request, GalleryItem $item)
    {
        $data = $request->validated();
        $path = ImageUpload::store($request->file('photo'));

        if ($path) {
            ImageUpload::delete($item->image);
            $data['image'] = $path;
        }

        unset($data['photo']);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $item->update($data);

        return redirect()->route('admin.gallery')->with('status', 'Foto galeri diperbarui.');
    }

    public function destroy(GalleryItem $item)
    {
        ImageUpload::delete($item->image);
        $item->delete();

        return redirect()->route('admin.gallery')->with('status', 'Foto dihapus dari galeri.');
    }
}