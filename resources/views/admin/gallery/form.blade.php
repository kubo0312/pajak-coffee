@extends('layouts.admin')

@section('title', $item->exists ? 'Ubah foto' : 'Foto baru')

@section('content')
@php($editing = $item->exists)

<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">{{ $editing ? 'Ubah foto' : 'Tambah foto' }}</h2>
        <p class="mt-1.5 text-sm text-muted">JPG, PNG, atau WebP. Maksimal 2 MB.</p>
    </div>
    <a href="{{ route('admin.gallery') }}"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:w-full">Kembali</a>
</div>

<div class="mt-6 overflow-hidden rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">{{ $editing ? $item->caption : 'Detail foto' }}</h3>
        <span class="text-sm text-muted">Kolom bertanda bintang wajib diisi</span>
    </div>

    <form method="POST"
          action="{{ $editing ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid gap-[18px] p-[18px] min-[640px]:grid-cols-2 min-[640px]:p-[22px]">
            <div class="grid gap-2">
                <label for="caption" class="text-sm font-semibold">Keterangan foto *</label>
                <input id="caption" name="caption" type="text" value="{{ old('caption', $item->caption) }}" placeholder="Contoh: Ruang dalam, enam meja kayu" maxlength="120" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('caption')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="sort_order" class="text-sm font-semibold">Urutan tampil</label>
                <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $item->sort_order ?? 0) }}"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('sort_order')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="photo" class="text-sm font-semibold">Foto {{ $editing ? '(kosongkan kalau tidak diganti)' : '*' }}</label>
                <input id="photo" name="photo" type="file" accept="image/*"
                       class="w-full rounded-ctl border border-[#D7D3C8] bg-[#FAF9F5] p-2 text-sm">
                @error('photo')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            @if ($editing)
                <div class="grid gap-2 min-[640px]:col-span-2">
                    <span class="text-sm font-semibold">Foto sekarang</span>
                    <img class="w-full max-w-[240px] rounded-ctl border border-line" src="{{ asset($item->image) }}" alt="{{ $item->caption }}">
                </div>
            @endif
        </div>

        <div class="flex flex-wrap gap-2.5 px-[18px] pb-[18px] min-[640px]:px-[22px] min-[640px]:pb-[22px]">
            <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover max-[639px]:flex-1">{{ $editing ? 'Simpan perubahan' : 'Tambah foto' }}</button>
            <a href="{{ route('admin.gallery') }}"
               class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:flex-1">Batal</a>
        </div>
    </form>
</div>
@endsection