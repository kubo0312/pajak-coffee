@extends('layouts.admin')

@section('title', 'Profil usaha')

@section('content')
<div class="admin-head">
  <div>
    <h2 style="font-size:1.5rem">Profil usaha</h2>
    <p class="muted small" style="margin-top:6px">Dipakai di beranda, halaman Tentang, dan footer.</p>
  </div>
  <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('home') }}" target="_blank" rel="noopener">Lihat hasilnya</a>
</div>

<div class="panel" style="margin-top:24px">
  <div class="panel-head">
    <h3 style="font-size:1rem;font-weight:600;letter-spacing:0">Data usaha</h3>
    <span class="muted small">Kolom bertanda bintang wajib diisi</span>
  </div>

  <form method="POST" action="{{ route('admin.profile.update') }}">
    @csrf @method('PUT')

    <div class="form-grid">
      <div class="field">
        <label for="name">Nama usaha *</label>
        <input id="name" name="name" type="text" value="{{ old('name', $site->name) }}" maxlength="80" required>
        @error('name')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="brand_mark">Inisial logo *</label>
        <input id="brand_mark" name="brand_mark" type="text" value="{{ old('brand_mark', $site->brand_mark) }}" maxlength="4" required>
        <span class="hint">Maksimal 4 karakter, contoh PC</span>
        @error('brand_mark')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="tagline">Tagline *</label>
        <input id="tagline" name="tagline" type="text" value="{{ old('tagline', $site->tagline) }}" maxlength="120" required>
        @error('tagline')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="hero_title">Judul beranda *</label>
        <input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $site->hero_title) }}" maxlength="160" required>
        @error('hero_title')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="hero_lead">Paragraf pembuka beranda *</label>
        <textarea id="hero_lead" name="hero_lead" maxlength="500" required>{{ old('hero_lead', $site->hero_lead) }}</textarea>
        @error('hero_lead')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="about">Tentang usaha *</label>
        <textarea id="about" name="about" maxlength="1000" required>{{ old('about', $site->about) }}</textarea>
        @error('about')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="vision">Visi *</label>
        <textarea id="vision" name="vision" maxlength="500" required>{{ old('vision', $site->vision) }}</textarea>
        @error('vision')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field full">
        <label for="mission">Misi *</label>
        <textarea id="mission" name="mission" maxlength="1000" required>{{ old('mission', implode("\n", $site->mission ?? [])) }}</textarea>
        <span class="hint">Satu poin per baris. Nomor urut dibuat otomatis.</span>
        @error('mission')<p class="err">{{ $message }}</p>@enderror
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary" style="height:40px" type="submit">Simpan perubahan</button>
      <a class="btn btn-ghost" style="height:40px;display:inline-flex;align-items:center" href="{{ route('admin.dashboard') }}">Batal</a>
    </div>
  </form>
</div>
@endsection