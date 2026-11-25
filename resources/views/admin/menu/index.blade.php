@extends('layouts.admin')

@section('title', 'Menu')

@section('content')
<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">Menu</h2>
    <p class="muted small" style="margin-top:6px">Semua menu yang tampil di halaman publik.</p>
  </div>
  <a class="btn btn-primary" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.menu.create') }}">Tambah menu</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">Daftar menu</h3>
    <span class="muted small">{{ $menus->count() }} menu</span>
  </div>
  <table>
    <thead>
      <tr><th>Foto</th><th>Nama menu</th><th>Kategori</th><th>Harga</th><th>Status</th><th>Urutan</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse ($menus as $menu)
        <tr>
          <td><img class="thumb" src="{{ $menu->image_url }}" alt=""></td>
          <td>{{ $menu->name }} @if ($menu->is_featured)<span class="tag" style="margin-left:6px">Unggulan</span>@endif</td>
          <td>{{ $menu->category->name }}</td>
          <td>{{ $menu->price_plain }}</td>
          <td>
            @if ($menu->is_available)
              <span class="tag">Tersedia</span>
            @else
              <span class="tag off">Habis</span>
            @endif
          </td>
          <td class="muted">{{ $menu->sort_order }}</td>
          <td>
            <div class="row-actions">
              <a class="mini" style="display:inline-flex;align-items:center" href="{{ route('admin.menu.edit', $menu) }}">Ubah</a>
              <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}" onsubmit="return confirm('Hapus {{ $menu->name }}?')">
                @csrf @method('DELETE')
                <button class="mini" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="empty">Belum ada menu.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection