@extends('layouts.app')

@section('title', 'Lokasi & Kontak - '.$profile->name)

@section('content')
<section class="animate-rise">
    <div class="mx-auto w-full max-w-page px-6 pb-2 pt-16 max-[639px]:pt-10">
        <h1>Lokasi &amp; Kontak</h1>
        <p class="mt-3 max-w-[52ch] text-muted">Ada di {{ $profile->address }}, sekitar 400 meter dari Simpang Rimba Sekampung.</p>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="mt-2 grid items-start gap-10 max-[959px]:gap-8 min-[960px]:grid-cols-[.9fr_1.1fr]">
            <div>
                <div class="rounded-card border border-line bg-surface p-6 max-[639px]:p-5">
                    <h3 class="text-base font-semibold tracking-normal">Alamat</h3>
                    <p class="mt-1.5 block text-[.9375rem] text-muted">{!! nl2br(e($profile->address)) !!}</p>
                </div>

                <div class="mt-4 rounded-card border border-line bg-surface p-6 max-[639px]:p-5">
                    <h3 class="text-base font-semibold tracking-normal">Jam operasional</h3>
                    @foreach ($profile->hours as $hour)
                        <p class="mt-1.5 block text-[.9375rem] text-muted">{{ $hour['label'] }}: {{ $hour['value'] }}</p>
                    @endforeach
                </div>

                <div class="mt-4 rounded-card border border-line bg-surface p-6 max-[639px]:p-5">
                    <h3 class="text-base font-semibold tracking-normal">Kontak</h3>
                    @if ($profile->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}" class="mt-1.5 block text-[.9375rem] text-muted hover:text-accent">Telepon: {{ $profile->phone }}</a>
                    @endif
                    @if ($profile->whatsapp)
                        <a href="https://wa.me/{{ $profile->whatsapp }}" class="mt-1.5 block text-[.9375rem] text-muted hover:text-accent">WhatsApp: {{ $profile->phone }}</a>
                    @endif
                    @if ($profile->instagram)
                        <a href="https://instagram.com/{{ $profile->instagram }}" class="mt-1.5 block text-[.9375rem] text-muted hover:text-accent">Instagram: {{ '@'.$profile->instagram }}</a>
                    @endif
                </div>
            </div>

            <div class="min-h-[420px] overflow-hidden rounded-card border border-line bg-surface-2 max-[639px]:min-h-[280px]">
                <iframe title="Peta lokasi {{ $profile->name }}"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q={{ urlencode($profile->map_query) }}&z=16&output=embed"
                        class="block h-full min-h-[420px] w-full border-0 max-[639px]:min-h-[280px]"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection