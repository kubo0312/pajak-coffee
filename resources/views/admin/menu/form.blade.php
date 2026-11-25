@extends('layouts.admin')

@section('title', $menu->exists ? 'Ubah menu' : 'Menu baru')

@section('content')
@php($editing = $menu->exists)

<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">{{ $editing ? 'Ubah menu' : 'Menu baru' }}</h2>
        <p class="mt-1.5 text-sm text-muted">{{ $editing ? $menu->name : 'Isi data menu yang mau ditambahkan.' }}</p>
    </div>
    <a href="{{ route('admin.menu.index') }}"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:w-full">Kembali</a>
</div>

<div class="mt-6 overflow-hidden rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">{{ $editing ? 'Detail menu' : 'Tambah menu' }}</h3>
        <span class="text-sm text-muted">Kolom bertanda bintang wajib diisi</span>
    </div>

    <form method="POST"
          action="{{ $editing ? route('admin.menu.update', $menu) : route('admin.menu.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid gap-[18px] p-[18px] min-[640px]:grid-cols-2 min-[640px]:p-[22px]">
            <div class="grid gap-2">
                <label for="name" class="text-sm font-semibold">Nama menu *</label>
                <input id="name" name="name" type="text" value="{{ old('name', $menu->name) }}" placeholder="Contoh: Es Kopi Susu" maxlength="80" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('name')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="category_id" class="text-sm font-semibold">Kategori *</label>
                <select id="category_id" name="category_id" required
                        class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id', $menu->category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="price" class="text-sm font-semibold">Harga *</label>
                <input id="price" name="price" type="number" min="0" max="1000000" step="500" value="{{ old('price', $menu->price) }}" placeholder="18000" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Isi angka saja, tanpa titik.</span>
                @error('price')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="is_available" class="text-sm font-semibold">Status</label>
                <select id="is_available" name="is_available"
                        class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                    <option value="1" @selected((string) old('is_available', (int) $menu->is_available) === '1')>Tersedia</option>
                    <option value="0" @selected((string) old('is_available', (int) $menu->is_available) === '0')>Habis</option>
                </select>
                @error('is_available')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="description" class="text-sm font-semibold">Deskripsi</label>
                <textarea id="description" name="description" maxlength="255" placeholder="Bahan dan penyajian singkat"
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('description', $menu->description) }}</textarea>
                @error('description')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="photo" class="text-sm font-semibold">Foto menu {{ $editing ? '(kosongkan kalau tidak diganti)' : '' }}</label>
                <input id="photo" name="photo" type="file" accept="image/*"
                       class="w-full rounded-ctl border border-[#D7D3C8] bg-[#FAF9F5] p-2 text-sm">
                <span class="text-[.8125rem] text-muted">JPG atau PNG, maksimal 2 MB.</span>
                @error('photo')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="image" class="text-sm font-semibold">Atau path foto manual</label>
                <input id="image" name="image" type="text" value="{{ old('image', $menu->image) }}" placeholder="assets/iced-latte.jpg"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Dipakai kalau tidak upload file. Kosongkan untuk memakai foto bawaan.</span>
                @error('image')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            @if ($editing && $menu->image)
                <div class="grid gap-2 min-[640px]:col-span-2">
                    <span class="text-sm font-semibold">Foto sekarang</span>
                    <img class="w-full max-w-[240px] rounded-ctl border border-line" src="{{ asset($menu->image ?: 'assets/espresso.jpg') }}" alt="{{ $menu->name }}">
                </div>
            @endif

            <div class="grid gap-2">
                <label for="sort_order" class="text-sm font-semibold">Urutan tampil</label>
                <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $menu->sort_order ?? 0) }}"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('sort_order')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <label class="flex items-center gap-2.5 pt-1.5 text-sm">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $menu->is_featured))
                       class="size-[18px] accent-accent">
                Tampilkan di bagian unggulan beranda
            </label>
        </div>

        <div class="flex flex-wrap gap-2.5 px-[18px] pb-[18px] min-[640px]:px-[22px] min-[640px]:pb-[22px]">
            <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover max-[639px]:flex-1">{{ $editing ? 'Simpan perubahan' : 'Simpan menu' }}</button>
            <a href="{{ route('admin.menu.index') }}"
               class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:flex-1">Batal</a>
        </div>
    </form>
</div>
@endsection