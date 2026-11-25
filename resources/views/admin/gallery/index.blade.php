@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">Galeri</h2>
    <p class="muted small" style="margin-top:6px">Foto yang tampil di halaman Galeri, urut dari nomor terkecil.</p>
  </div>
  <a class="btn btn-primary" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.gallery.create') }}">Tambah foto</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">Daftar foto</h3>
    <span class="muted small">{{ $items->count() }} foto</span>
  </div>
  <table>
    <thead>
      <tr><th>Foto</th><th>Keterangan</th><th>Urutan</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse ($items as $item)
        <tr>
          <td><img class="thumb" src="{{ $item->image_url }}" alt=""></td>
          <td>{{ $item->caption }}</td>
          <td class="muted">{{ $item->sort_order }}</td>
          <td>
            <div class="row-actions">
              <a class="mini" style="display:inline-flex;align-items:center" href="{{ route('admin.gallery.edit', $item) }}">Ubah</a>
              <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                @csrf @method('DELETE')
                <button class="mini" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="empty">Galeri masih kosong.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection