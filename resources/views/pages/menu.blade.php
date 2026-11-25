@extends('layouts.app')

@section('title', 'Menu - '.$profile->name)

@section('content')
<section class="animate-rise">
    <div class="mx-auto w-full max-w-page px-6 pb-2 pt-16 max-[639px]:pt-10">
        <h1>Menu</h1>
        <p class="mt-3 max-w-[52ch] text-muted">Harga sudah termasuk pajak. Menu bertanda tersedia bisa langsung dipesan di kasir.</p>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="mb-[26px] mt-7 flex flex-wrap gap-2 max-[639px]:mb-[22px] max-[639px]:mt-5" role="group" aria-label="Filter kategori menu">
            <a href="{{ route('menu') }}" aria-pressed="{{ $activeCategory ? 'false' : 'true' }}"
               class="inline-flex h-[38px] items-center rounded-ctl border border-line px-[18px] text-sm font-semibold text-muted transition hover:border-border-hover hover:text-ink aria-[pressed=true]:border-ink aria-[pressed=true]:bg-ink aria-[pressed=true]:text-white">Semua</a>

            @foreach ($categories as $category)
                <a href="{{ route('menu', ['kategori' => $category->slug]) }}"
                   aria-pressed="{{ $activeCategory?->id === $category->id ? 'true' : 'false' }}"
                   class="inline-flex h-[38px] items-center rounded-ctl border border-line px-[18px] text-sm font-semibold text-muted transition hover:border-border-hover hover:text-ink aria-[pressed=true]:border-ink aria-[pressed=true]:bg-ink aria-[pressed=true]:text-white">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="grid gap-6 max-[639px]:gap-[18px] min-[640px]:grid-cols-2 min-[960px]:grid-cols-3">
            @forelse ($menus as $menu)
                <article class="overflow-hidden rounded-card border border-line bg-surface transition hover:-translate-y-[3px] hover:shadow-card" data-cat="{{ $menu->category->slug }}">
                    <div class="aspect-[16/10] overflow-hidden bg-surface-2">
                        <img src="{{ asset($menu->image ?: 'assets/espresso.jpg') }}" alt="{{ $menu->name }}" loading="lazy">
                    </div>
                    <div class="px-5 pb-5 pt-[18px]">
                        <div class="flex items-baseline justify-between gap-3">
                            <h3 class="text-[1.0625rem]">{{ $menu->name }}</h3>
                            <span class="whitespace-nowrap text-[.9375rem] font-semibold text-accent">Rp{{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                        <p class="mt-1.5 text-sm text-muted">{{ $menu->description }}</p>
                    </div>
                </article>
            @empty
                <p class="col-span-full py-11 text-center text-[.9375rem] text-muted">Belum ada menu di kategori ini.</p>
            @endforelse
        </div>

        <p class="mt-6 text-sm text-muted">Punya alergi atau minta less sugar? Sebut saja ke kasir.</p>
    </div>
</section>
@endsection