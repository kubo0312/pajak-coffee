<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', $profile->name.' - '.$profile->tagline)</title>
<meta name="description" content="@yield('description', $profile->tagline)">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@include('partials.nav')

<main class="animate-rise">
    @if (session('status'))
        <div class="mx-auto w-full max-w-page px-6">
            <div class="mt-5 rounded-ctl border border-accent-soft bg-accent-soft px-4 py-3 text-sm font-semibold text-accent">
                {{ session('status') }}
            </div>
        </div>
    @endif

    @yield('content')
</main>

<footer class="mt-6 bg-dark py-14 pb-7 text-on-dark">
    <div class="mx-auto w-full max-w-page px-6">
        <div class="grid gap-10 min-[640px]:grid-cols-2 min-[960px]:grid-cols-[1.3fr_.8fr_.9fr]">
            <div>
                <div class="mb-3.5 flex items-center gap-2.5 text-[1.0625rem] font-extrabold tracking-[-.03em] text-white">
                    <span class="grid size-[30px] place-items-center rounded-[9px] bg-accent text-[.8125rem] font-extrabold leading-none tracking-normal text-white">{{ $profile->brand_mark }}</span>
                    {{ $profile->name }}
                </div>
                <p class="text-sm text-on-dark-muted">Kedai kopi di {{ $profile->address }}. Buka setiap hari sampai tengah malam.</p>
            </div>

            <div>
                <h3 class="mb-3.5 text-sm font-semibold tracking-normal text-white">Halaman</h3>
                <div class="grid gap-2 text-sm text-on-dark-muted">
                    <a href="{{ route('about') }}" class="hover:text-white">Tentang</a>
                    <a href="{{ route('menu') }}" class="hover:text-white">Menu</a>
                    <a href="{{ route('gallery') }}" class="hover:text-white">Galeri</a>
                    <a href="{{ route('contact') }}" class="hover:text-white">Lokasi &amp; Kontak</a>
                </div>
            </div>

            <div>
                <h3 class="mb-3.5 text-sm font-semibold tracking-normal text-white">Kontak</h3>
                <div class="grid gap-2 text-sm text-on-dark-muted">
                    @if ($profile->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}" class="hover:text-white">{{ $profile->phone }}</a>
                    @endif
                    @if ($profile->whatsapp)
                        <a href="https://wa.me/{{ $profile->whatsapp }}" class="hover:text-white">WhatsApp</a>
                    @endif
                    @if ($profile->instagram)
                        <a href="https://instagram.com/{{ $profile->instagram }}" class="hover:text-white">{{ '@'.$profile->instagram }}</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap justify-between gap-4 border-t border-white/15 pt-5 text-[.8125rem] text-on-dark-muted">
            <span>© {{ date('Y') }} {{ $profile->name }} Dumai</span>
            <span>Website company profile, tugas Metodologi Penelitian</span>
        </div>
    </div>
</footer>

<div id="modal" role="dialog" aria-modal="true" aria-label="Foto galeri"
     class="fixed inset-0 z-[60] hidden place-items-center bg-[rgb(15_17_15/_.86)] p-8">
    <button id="modalClose" type="button" aria-label="Tutup"
            class="absolute right-6 top-5 grid size-10 place-items-center rounded-full border border-white/30 bg-white/10 text-[1.125rem] text-white transition-colors hover:bg-white/20">✕</button>
    <figure class="grid max-h-[86vh] max-w-[min(960px,92vw)] gap-3">
        <img id="modalImg" alt="" class="max-h-[78vh] w-full rounded-card object-contain">
        <figcaption id="modalCap" class="text-center text-sm text-[#E9E7DF]"></figcaption>
    </figure>
</div>

</body>
</html>