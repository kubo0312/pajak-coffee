@extends('layouts.admin')

@section('title', 'Kategori menu')

@section('content')
<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">Kategori menu</h2>
    <p class="muted small" style="margin-top:6px">Kategori dipakai untuk filter di halaman Menu.</p>
  </div>
  <a class="btn btn-primary" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.categories.create') }}">Tambah kategori</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">Daftar kategori</h3>
    <span class="muted small">{{ $categories->count() }} kategori</span>
  </div>
  <table>
    <thead>
      <tr><th>Nama</th><th>Slug</th><th>Jumlah menu</th><th>Urutan</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse ($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
          <td class="muted">{{ $category->slug }}</td>
          <td>{{ $category->menus_count }}</td>
          <td class="muted">{{ $category->sort_order }}</td>
          <td>
            <div class="row-actions">
              <a class="mini" style="display:inline-flex;align-items:center" href="{{ route('admin.categories.edit', $category) }}">Ubah</a>
              <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                @csrf @method('DELETE')
                <button class="mini" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="empty">Belum ada kategori.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection