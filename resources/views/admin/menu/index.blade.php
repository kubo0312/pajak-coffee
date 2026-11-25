@extends('layouts.admin')

@section('title', 'Menu')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">Menu</h2>
        <p class="mt-1.5 text-sm text-muted">Semua menu yang tampil di halaman publik.</p>
    </div>
    <a href="{{ route('admin.menu.create') }}"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover max-[639px]:w-full">Tambah menu</a>
</div>

<div class="mt-6 overflow-x-auto rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">Daftar menu</h3>
        <span class="text-sm text-muted">{{ $menus->count() }} menu</span>
    </div>

    <table class="w-full border-collapse text-sm">
        <thead>
            <tr>
                @foreach (['Foto', 'Nama menu', 'Kategori', 'Harga', 'Status', 'Urutan', 'Aksi'] as $th)
                    <th class="bg-[#FAF9F5] px-[22px] py-3 text-left text-[.8125rem] font-semibold text-muted max-[639px]:px-3">{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3"><img class="size-11 rounded-[10px] object-cover" src="{{ asset($menu->image ?: 'assets/espresso.jpg') }}" alt=""></td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3 max-[639px]:whitespace-nowrap">
                        {{ $menu->name }}
                        @if ($menu->is_featured)
                            <span class="ml-1.5 inline-block rounded-full bg-accent-soft px-2.5 py-[3px] text-xs font-semibold text-accent">Unggulan</span>
                        @endif
                    </td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3 max-[639px]:whitespace-nowrap">{{ $menu->category->name }}</td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3 max-[639px]:whitespace-nowrap">{{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3">
                        @if ($menu->is_available)
                            <span class="inline-block rounded-full bg-accent-soft px-2.5 py-[3px] text-xs font-semibold text-accent">Tersedia</span>
                        @else
                            <span class="inline-block rounded-full bg-[#F0EEE8] px-2.5 py-[3px] text-xs font-semibold text-[#6A665E]">Habis</span>
                        @endif
                    </td>
                    <td class="border-t border-line px-[22px] py-3 align-middle text-muted max-[639px]:px-3">{{ $menu->sort_order }}</td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3">
                        <div class="flex gap-2">
                            <a class="inline-flex h-8 items-center rounded-lg border border-line bg-white px-3 text-[.8125rem] font-semibold text-muted transition hover:border-border-hover hover:text-ink" href="{{ route('admin.menu.edit', $menu) }}">Ubah</a>
                            <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}" onsubmit="return confirm('Hapus {{ $menu->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex h-8 items-center rounded-lg border border-line bg-white px-3 text-[.8125rem] font-semibold text-muted transition hover:border-border-hover hover:text-ink">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-[22px] py-11 text-center text-[.9375rem] text-muted">Belum ada menu.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection