@extends('layouts.admin')

@section('title', $item->exists ? 'Ubah foto' : 'Foto baru')

@section('content')
@php($editing = $item->exists)

<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">{{ $editing ? 'Ubah foto' : 'Tambah foto' }}</h2>
    <p class="muted small" style="margin-top:6px">JPG, PNG, atau WebP. Maksimal 2 MB.</p>
  </div>
  <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.gallery') }}">Kembali</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">{{ $editing ? $item->caption : 'Detail foto' }}</h3>
    <span class="muted small">Kolom bertanda bintang wajib diisi</span>
  </div>

  <form method="POST"
        action="{{ $editing ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if ($editing) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label for="caption">Keterangan foto *</label>
        <input id="caption" name="caption" type="text" value="{{ old('caption', $item->caption) }}" placeholder="Contoh: Ruang dalam, enam meja kayu" maxlength="120" required>
        @error('caption')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="sort_order">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
        @error('sort_order')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="photo">Foto {{ $editing ? '(kosongkan kalau tidak diganti)' : '*' }}</label>
        <input id="photo" name="photo" type="file" accept="image/*">
        @error('photo')<p class="err">{{ $message }}</p>@enderror
      </div>

      @if ($editing)
        <div class="field full">
          <label>Foto sekarang</label>
          <img class="preview" src="{{ $item->image_url }}" alt="{{ $item->caption }}">
        </div>
      @endif
    </div>

    <div class="form-actions">
      <button class="btn btn-primary" style="height:40px" type="submit">{{ $editing ? 'Simpan perubahan' : 'Tambah foto' }}</button>
      <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.gallery') }}">Batal</a>
    </div>
  </form>
</div>
@endsection