@extends('layouts.admin')

@section('title', 'Lokasi & kontak')

@section('content')
<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">Lokasi &amp; kontak</h2>
    <p class="muted small" style="margin-top:6px">Dipakai di halaman Lokasi &amp; Kontak, footer, dan peta.</p>
  </div>
  <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('contact') }}" target="_blank" rel="noopener">Lihat hasilnya</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">Alamat &amp; kontak</h3>
    <span class="muted small">Kolom bertanda bintang wajib diisi</span>
  </div>

  <form method="POST" action="{{ route('admin.contact.update') }}">
    @csrf @method('PUT')

    @php
      $hoursText = collect($site->hours ?? [])
        ->map(fn ($row) => trim(($row['label'] ?? '').' | '.($row['value'] ?? '')))
        ->implode("\n");
    @endphp

    <div class="form-grid">
      <div class="field full">
        <label for="address">Alamat *</label>
        <textarea id="address" name="address" maxlength="255" required>{{ old('address', $site->address) }}</textarea>
        @error('address')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="hours">Jam operasional *</label>
        <textarea id="hours" name="hours" maxlength="500" required>{{ old('hours', $hoursText) }}</textarea>
        <span class="hint">Satu baris per jadwal, format: keterangan | jam. Contoh: Senin - Jumat | 10.00 - 24.00</span>
        @error('hours')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="phone">Telepon</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $site->phone) }}" maxlength="30">
        @error('phone')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="whatsapp">Nomor WhatsApp</label>
        <input id="whatsapp" name="whatsapp" type="text" value="{{ old('whatsapp', $site->whatsapp) }}" maxlength="30">
        <span class="hint">Format internasional tanpa tanda plus, contoh 6281266002451</span>
        @error('whatsapp')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="instagram">Instagram</label>
        <input id="instagram" name="instagram" type="text" value="{{ old('instagram', $site->instagram) }}" maxlength="60">
        <span class="hint">Nama pengguna tanpa @</span>
        @error('instagram')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="map_query">Pencarian peta *</label>
        <input id="map_query" name="map_query" type="text" value="{{ old('map_query', $site->map_query) }}" maxlength="255" required>
        <span class="hint">Teks yang dicari di Google Maps</span>
        @error('map_query')<p class="err">{{ $message }}</p>@enderror
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary" style="height:40px" type="submit">Simpan perubahan</button>
      <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.dashboard') }}">Batal</a>
    </div>
  </form>
</div>
@endsection