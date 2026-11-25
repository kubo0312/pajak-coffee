@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 max-[639px]:gap-3">
    <div>
        <h2 class="text-2xl">Galeri</h2>
        <p class="mt-1.5 text-sm text-muted">Foto yang tampil di halaman Galeri, urut dari nomor terkecil.</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}"
       class="inline-flex h-10 items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover max-[639px]:w-full">Tambah foto</a>
</div>

<div class="mt-6 overflow-x-auto rounded-card border border-line bg-surface">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-line px-[22px] py-[18px]">
        <h3 class="text-base font-semibold tracking-normal">Daftar foto</h3>
        <span class="text-sm text-muted">{{ $items->count() }} foto</span>
    </div>

    <table class="w-full border-collapse text-sm">
        <thead>
            <tr>
                @foreach (['Foto', 'Keterangan', 'Urutan', 'Aksi'] as $th)
                    <th class="bg-[#FAF9F5] px-[22px] py-3 text-left text-[.8125rem] font-semibold text-muted max-[639px]:px-3">{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3"><img class="size-11 rounded-[10px] object-cover" src="{{ asset($item->image) }}" alt=""></td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3 max-[639px]:whitespace-nowrap">{{ $item->caption }}</td>
                    <td class="border-t border-line px-[22px] py-3 align-middle text-muted max-[639px]:px-3">{{ $item->sort_order }}</td>
                    <td class="border-t border-line px-[22px] py-3 align-middle max-[639px]:px-3">
                        <div class="flex gap-2">
                            <a class="inline-flex h-8 items-center rounded-lg border border-line bg-white px-3 text-[.8125rem] font-semibold text-muted transition hover:border-border-hover hover:text-ink" href="{{ route('admin.gallery.edit', $item) }}">Ubah</a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex h-8 items-center rounded-lg border border-line bg-white px-3 text-[.8125rem] font-semibold text-muted transition hover:border-border-hover hover:text-ink">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-[22px] py-11 text-center text-[.9375rem] text-muted">Galeri masih kosong.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection