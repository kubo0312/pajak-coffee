@extends('layouts.app')

@section('title', 'Galeri - '.$profile->name)

@section('content')
<section class="animate-rise">
    <div class="mx-auto w-full max-w-page px-6 pb-2 pt-16 max-[639px]:pt-10">
        <h1>Galeri</h1>
        <p class="mt-3 max-w-[52ch] text-muted">Suasana kedai, meja, dan menu. Ketuk foto untuk melihat lebih besar.</p>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div id="gallery" class="grid gap-5 max-[639px]:gap-3 min-[640px]:grid-cols-2 min-[960px]:grid-cols-3">
            @forelse ($items as $item)
                <button type="button" data-full="{{ asset($item->image) }}" data-cap="{{ $item->caption }}"
                        class="group relative block aspect-square w-full cursor-zoom-in overflow-hidden rounded-card bg-surface-2 p-0">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->caption }}" loading="lazy"
                         class="transition-transform duration-[350ms] ease-[cubic-bezier(.16,1,.3,1)] group-hover:scale-[1.03]">
                </button>
            @empty
                <p class="col-span-full py-11 text-center text-[.9375rem] text-muted">Belum ada foto di galeri.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection