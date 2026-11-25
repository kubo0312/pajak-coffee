@extends('layouts.admin')

@section('title', $category->exists ? 'Ubah kategori' : 'Kategori baru')

@section('content')
@php($editing = $category->exists)

<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">{{ $editing ? 'Ubah kategori' : 'Kategori baru' }}</h2>
    <p class="muted small" style="margin-top:6px">{{ $editing ? 'Slug tidak ikut berubah supaya filter menu tetap jalan.' : 'Nama kategori akan dipakai sebagai label filter.' }}</p>
  </div>
  <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.categories') }}">Kembali</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">{{ $editing ? $category->name : 'Detail kategori' }}</h3>
    <span class="muted small">Kolom bertanda bintang wajib diisi</span>
  </div>

  <form method="POST" action="{{ $editing ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
    @csrf
    @if ($editing) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label for="name">Nama kategori *</label>
        <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" placeholder="Contoh: Kopi Susu" maxlength="40" required>
        @error('name')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="sort_order">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
        @error('sort_order')<p class="err">{{ $message }}</p>@enderror
      </div>

      @if ($editing)
        <div class="field full">
          <label>Slug</label>
          <input type="text" value="{{ $category->slug }}" disabled>
          <span class="hint">Dipakai di URL filter, contoh /menu?kategori={{ $category->slug }}</span>
        </div>
      @endif
    </div>

    <div class="form-actions">
      <button class="btn btn-primary" style="height:40px" type="submit">{{ $editing ? 'Simpan perubahan' : 'Tambah kategori' }}</button>
      <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.categories') }}">Batal</a>
    </div>
  </form>
</div>
@endsection