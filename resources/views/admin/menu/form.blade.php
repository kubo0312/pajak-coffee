@extends('layouts.admin')

@section('title', $menu->exists ? 'Ubah menu' : 'Menu baru')

@section('content')
@php($editing = $menu->exists)

<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">{{ $editing ? 'Ubah menu' : 'Menu baru' }}</h2>
    <p class="muted small" style="margin-top:6px">{{ $editing ? $menu->name : 'Isi data menu yang mau ditambahkan.' }}</p>
  </div>
  <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.menu.index') }}">Kembali</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">{{ $editing ? 'Detail menu' : 'Tambah menu' }}</h3>
    <span class="muted small">Kolom bertanda bintang wajib diisi</span>
  </div>

  <form method="POST"
        action="{{ $editing ? route('admin.menu.update', $menu) : route('admin.menu.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if ($editing) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label for="name">Nama menu *</label>
        <input id="name" name="name" type="text" value="{{ old('name', $menu->name) }}" placeholder="Contoh: Es Kopi Susu" maxlength="80" required>
        @error('name')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="category_id">Kategori *</label>
        <select id="category_id" name="category_id" required>
          <option value="">Pilih kategori</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected((int) old('category_id', $menu->category_id) === $category->id)>{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="price">Harga *</label>
        <input id="price" name="price" type="number" min="0" max="1000000" step="500" value="{{ old('price', $menu->price) }}" placeholder="18000" required>
        <span class="hint">Isi angka saja, tanpa titik.</span>
        @error('price')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="is_available">Status</label>
        <select id="is_available" name="is_available">
          <option value="1" @selected((string) old('is_available', (int) $menu->is_available) === '1')>Tersedia</option>
          <option value="0" @selected((string) old('is_available', (int) $menu->is_available) === '0')>Habis</option>
        </select>
        @error('is_available')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" maxlength="255" placeholder="Bahan dan penyajian singkat">{{ old('description', $menu->description) }}</textarea>
        @error('description')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="photo">Foto menu {{ $editing ? '(kosongkan kalau tidak diganti)' : '' }}</label>
        <input id="photo" name="photo" type="file" accept="image/*">
        <span class="hint">JPG atau PNG, maksimal 2 MB.</span>
        @error('photo')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="image">Atau path foto manual</label>
        <input id="image" name="image" type="text" value="{{ old('image', $menu->image) }}" placeholder="assets/iced-latte.jpg">
        <span class="hint">Dipakai kalau tidak upload file. Kosongkan untuk memakai foto bawaan.</span>
        @error('image')<p class="err">{{ $message }}</p>@enderror
      </div>

      @if ($editing && $menu->image)
        <div class="field full">
          <label>Foto sekarang</label>
          <img class="preview" src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
        </div>
      @endif

      <div class="field">
        <label for="sort_order">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $menu->sort_order ?? 0) }}">
        @error('sort_order')<p class="err">{{ $message }}</p>@enderror
      </div>

      <label class="field-check">
        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $menu->is_featured))>
        Tampilkan di bagian unggulan beranda
      </label>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary" style="height:40px" type="submit">{{ $editing ? 'Simpan perubahan' : 'Simpan menu' }}</button>
      <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.menu.index') }}">Batal</a>
    </div>
  </form>
</div>
@endsection