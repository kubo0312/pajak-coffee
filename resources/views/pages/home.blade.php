@extends('layouts.app')

@section('title', $profile->name.' - '.$profile->tagline)

@section('content')
<section class="animate-rise pb-16 pt-14 max-[639px]:pb-11 max-[639px]:pt-7">
    <div class="mx-auto w-full max-w-page px-6">
        <div class="grid items-center gap-16 max-[959px]:gap-8 min-[960px]:grid-cols-[1.02fr_.98fr]">
            <div>
                <p class="mb-3 text-sm font-semibold text-accent">{{ $profile->tagline }}</p>
                <h1 class="max-w-[16ch]">{{ $profile->hero_title }}</h1>
                <p class="mt-5 max-w-[34ch] text-[1.125rem] text-muted max-[639px]:text-base">{{ $profile->hero_lead }}</p>

                <div class="mt-[30px] flex flex-wrap gap-3 max-[639px]:gap-2.5">
                    <a href="{{ route('menu') }}"
                       class="inline-flex h-[46px] items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold whitespace-nowrap text-white transition hover:bg-accent-hover active:translate-y-px max-[639px]:min-w-[140px] max-[639px]:flex-1">Lihat menu</a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex h-[46px] items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold whitespace-nowrap text-ink transition hover:bg-surface active:translate-y-px max-[639px]:min-w-[140px] max-[639px]:flex-1">Buka lokasi</a>
                </div>

                <div class="mt-[34px] flex flex-wrap gap-7 border-t border-line pt-[22px] max-[639px]:grid max-[639px]:grid-cols-2 max-[639px]:gap-x-5 max-[639px]:gap-y-4 max-[399px]:grid-cols-1">
                    <div>
                        <span class="block text-sm text-muted">Alamat</span>
                        <strong class="text-base font-semibold">Jl. Sultan Hasanuddin</strong>
                    </div>
                    <div>
                        <span class="block text-sm text-muted">Jam buka</span>
                        <strong class="text-base font-semibold">{{ $profile->hours[0]['value'] ?? '10.00 - 24.00' }}</strong>
                    </div>
                    <div class="max-[639px]:col-span-2 max-[399px]:col-span-1">
                        <span class="block text-sm text-muted">Tempat duduk</span>
                        <strong class="text-base font-semibold">Indoor &amp; teras</strong>
                    </div>
                </div>
            </div>

            @php($hero = $featured->first())
            <figure class="relative aspect-[5/6] overflow-hidden rounded-card border border-line bg-surface-2 shadow-card max-[959px]:order-first max-[959px]:aspect-[4/3]">
                <img src="{{ asset('assets/espresso.jpg') }}" alt="Secangkir espresso di meja kayu {{ $profile->name }}"
                     class="scale-[1.12] object-[50%_45%]" width="1600" height="2000">
                <figcaption class="absolute bottom-4 left-4 rounded-full bg-white/95 px-3.5 py-2 text-sm font-semibold text-ink">
                    {{ $hero->name ?? 'Espresso' }} · Rp{{ number_format($hero->price ?? 0, 0, ',', '.') }}
                </figcaption>
            </figure>
        </div>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="mb-[30px] flex flex-wrap items-end justify-between gap-6 max-[639px]:items-start max-[639px]:gap-3.5">
            <div>
                <h2>Yang paling sering dipesan</h2>
                <p class="mt-2 text-sm text-muted">Dari {{ $menuCount }} menu yang tersedia, ini tiga yang paling sering keluar.</p>
            </div>
            <a href="{{ route('menu') }}"
               class="inline-flex h-[46px] items-center justify-center rounded-ctl border border-border-hover px-[22px] text-sm font-semibold whitespace-nowrap text-ink transition hover:bg-surface active:translate-y-px max-[639px]:w-full">Semua menu</a>
        </div>

        <div class="grid gap-6 max-[959px]:gap-5 min-[960px]:grid-cols-3">
            @foreach ($featured as $menu)
                <article class="flex flex-col overflow-hidden rounded-card border border-line bg-surface transition hover:-translate-y-[3px] hover:shadow-card">
                    <div class="aspect-[4/3] shrink-0 overflow-hidden bg-surface-2">
                        <img src="{{ asset($menu->image ?: 'assets/espresso.jpg') }}" alt="{{ $menu->name }}" loading="lazy">
                    </div>
                    <div class="flex-1 px-5 pb-5 pt-[18px]">
                        <div class="flex items-baseline justify-between gap-3">
                            <h3 class="{{ $loop->first ? '' : 'text-base' }}">{{ $menu->name }}</h3>
                            <span class="whitespace-nowrap text-[.9375rem] font-semibold text-accent">Rp{{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                        <p class="mt-1.5 text-sm text-muted">{{ $menu->description }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="grid items-center gap-10 rounded-card bg-accent p-11 text-on-dark max-[959px]:gap-8 max-[639px]:p-7 min-[960px]:grid-cols-[1.1fr_.9fr]">
            <div>
                <h2 class="text-white">Ngopi sampai tengah malam.</h2>
                <p class="mt-3.5 max-w-[44ch] text-[#D5DED6]">{{ $profile->name }} buka setiap hari, termasuk Minggu. Jam paling ramai pukul 20.00 sampai 23.00.</p>
                <div class="mt-[26px] flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}"
                       class="inline-flex h-[46px] items-center justify-center rounded-ctl border border-transparent bg-white px-[22px] text-sm font-semibold whitespace-nowrap text-accent transition hover:bg-white/90 active:translate-y-px max-[639px]:w-full">Petunjuk arah</a>
                </div>
            </div>

            <div class="mt-[22px] grid gap-0.5">
                @foreach ($profile->hours as $hour)
                    <div class="flex justify-between gap-4 border-b border-white/20 py-2.5 text-sm last:border-0">
                        <span class="text-[#C7D2C9]">{{ $hour['label'] }}</span>
                        <strong class="font-semibold">{{ $hour['value'] }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection