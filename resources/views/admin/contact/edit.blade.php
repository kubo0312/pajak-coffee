@extends('layouts.admin')

@section('title', 'Lokasi & kontak')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">Lokasi &amp; kontak</h2>
        <p class="mt-1.5 text-sm text-muted">Dipakai di halaman Lokasi &amp; Kontak, footer, dan peta.</p>
    </div>
    <a href="{{ route('contact') }}" target="_blank" rel="noopener"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold text-ink transition hover:bg-surface max-[639px]:w-full">Lihat hasilnya</a>
</div>

<div class="mt-6 overflow-hidden rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">Alamat &amp; kontak</h3>
        <span class="text-sm text-muted">Kolom bertanda bintang wajib diisi</span>
    </div>

    <form method="POST" action="{{ route('admin.contact.update') }}">
        @csrf @method('PUT')

        <div class="grid gap-[18px] p-[18px] min-[640px]:grid-cols-2 min-[640px]:p-[22px]">
            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="address" class="text-sm font-semibold">Alamat *</label>
                <textarea id="address" name="address" maxlength="255" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('address', $site->address) }}</textarea>
                @error('address')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2 min-[640px]:col-span-2">
                <label for="hours" class="text-sm font-semibold">Jam operasional *</label>
                <textarea id="hours" name="hours" maxlength="500" required
                          class="min-h-[88px] w-full resize-y rounded-ctl border border-[#D7D3C8] bg-white px-3.5 py-[11px] text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">{{ old('hours', $hoursText) }}</textarea>
                <span class="text-[.8125rem] text-muted">Satu baris per jadwal, format: keterangan | jam. Contoh: Senin - Jumat | 10.00 - 24.00</span>
                @error('hours')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="phone" class="text-sm font-semibold">Telepon</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $site->phone) }}" maxlength="30"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                @error('phone')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="whatsapp" class="text-sm font-semibold">Nomor WhatsApp</label>
                <input id="whatsapp" name="whatsapp" type="text" value="{{ old('whatsapp', $site->whatsapp) }}" maxlength="30"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Format internasional tanpa tanda plus, contoh 6281266002451</span>
                @error('whatsapp')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="instagram" class="text-sm font-semibold">Instagram</label>
                <input id="instagram" name="instagram" type="text" value="{{ old('instagram', $site->instagram) }}" maxlength="60"
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Nama pengguna tanpa @</span>
                @error('instagram')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-2">
                <label for="map_query" class="text-sm font-semibold">Pencarian peta *</label>
                <input id="map_query" name="map_query" type="text" value="{{ old('map_query', $site->map_query) }}" maxlength="255" required
                       class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
                <span class="text-[.8125rem] text-muted">Teks yang dicari di Google Maps</span>
                @error('map_query')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
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