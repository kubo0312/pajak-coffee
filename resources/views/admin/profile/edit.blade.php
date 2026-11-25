@extends('layouts.admin')

@section('title', 'Profil usaha')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">Profil usaha</h2>
        <p class="mt-1.5 text-sm text-muted">Dipakai di beranda, halaman Tentang, dan footer.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" rel="noopener"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:w-full">Lihat hasilnya</a>
</div>

<div class="mt-6 overflow-hidden rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">Data usaha</h3>
        <span class="text-sm text-muted">Kolom bertanda bintang wajib diisi</span>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf @method('PUT')

        <div class="grid gap-[18px] p-[18px] min-[640px]:grid-cols-2 min-[640px]:p-[22px]">
            <div class="grid gap-2">
                <label for="name" class="text-sm font-semibold">Nama usaha *</label>
                <input id="name" name="name" type="text" value="{{ old('name', $site->name) }}" maxlength="80" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('name')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="brand_mark" class="text-sm font-semibold">Inisial logo *</label>
                <input id="brand_mark" name="brand_mark" type="text" value="{{ old('brand_mark', $site->brand_mark) }}" maxlength="4" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Maksimal 4 karakter, contoh PC</span>
                @error('brand_mark')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="tagline" class="text-sm font-semibold">Tagline *</label>
                <input id="tagline" name="tagline" type="text" value="{{ old('tagline', $site->tagline) }}" maxlength="120" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('tagline')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="hero_title" class="text-sm font-semibold">Judul beranda *</label>
                <input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $site->hero_title) }}" maxlength="160" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('hero_title')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="hero_lead" class="text-sm font-semibold">Paragraf pembuka beranda *</label>
                <textarea id="hero_lead" name="hero_lead" maxlength="500" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('hero_lead', $site->hero_lead) }}</textarea>
                @error('hero_lead')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="about" class="text-sm font-semibold">Tentang usaha *</label>
                <textarea id="about" name="about" maxlength="1000" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('about', $site->about) }}</textarea>
                @error('about')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="vision" class="text-sm font-semibold">Visi *</label>
                <textarea id="vision" name="vision" maxlength="500" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('vision', $site->vision) }}</textarea>
                @error('vision')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="mission" class="text-sm font-semibold">Misi *</label>
                <textarea id="mission" name="mission" maxlength="1000" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('mission', $missionText) }}</textarea>
                <span class="text-[.8125rem] text-muted">Satu poin per baris. Nomor urut dibuat otomatis.</span>
                @error('mission')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-2.5 px-[18px] pb-[18px] min-[640px]:px-[22px] min-[640px]:pb-[22px]">
            <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover max-[639px]:flex-1">Simpan perubahan</button>
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:flex-1">Batal</a>
        </div>
    </form>
</div>
@endsection