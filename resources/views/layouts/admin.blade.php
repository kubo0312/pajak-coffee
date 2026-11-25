<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Admin') · {{ $profile->name }}</title>
<meta name="robots" content="noindex">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="sticky top-0 z-40 h-[68px] border-b border-line bg-canvas/90 backdrop-blur-md">
    <div class="mx-auto flex h-full w-full max-w-page items-center gap-8 px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-[1.0625rem] font-extrabold tracking-[-.03em]">
            <span class="grid size-[30px] place-items-center rounded-[9px] bg-accent text-[.8125rem] font-extrabold leading-none tracking-normal text-white">{{ $profile->brand_mark }}</span>
            {{ $profile->name }}
        </a>
        <a href="{{ route('home') }}"
           class="ml-auto rounded-ctl border border-line px-3.5 py-2 text-sm font-semibold text-muted transition-colors hover:border-border-hover hover:bg-surface hover:text-ink">Lihat website</a>
    </div>
</header>

<div class="grid min-h-[calc(100vh-68px)] min-[900px]:grid-cols-[232px_minmax(0,1fr)]">

    <aside class="bg-dark px-4 py-3 text-on-dark
                  max-[899px]:grid max-[899px]:grid-cols-[1fr_auto] max-[899px]:items-center max-[899px]:gap-x-3 max-[899px]:gap-y-2.5
                  min-[900px]:py-6">
        <div class="flex items-center gap-2.5 text-[1.0625rem] font-extrabold tracking-[-.03em] text-white
                    max-[899px]:col-start-1 max-[899px]:row-start-1 max-[899px]:whitespace-nowrap min-[900px]:px-2">
            <span class="grid size-[30px] place-items-center rounded-[9px] bg-accent text-[.8125rem] font-extrabold leading-none tracking-normal text-white">{{ $profile->brand_mark }}</span>
            Admin
        </div>

        <form method="POST" action="{{ route('logout') }}"
              class="max-[899px]:col-start-2 max-[899px]:row-start-1 max-[899px]:justify-self-end min-[900px]:mt-5">
            @csrf
            <button type="submit"
                    class="rounded-[10px] border border-white/20 px-3.5 py-2 text-sm text-on-dark-muted transition-colors hover:border-white/35 hover:text-white
                           min-[900px]:w-full min-[900px]:py-2.5">
                Keluar
            </button>
        </form>

        <nav class="mt-1 grid gap-1 max-[899px]:col-span-2 max-[899px]:row-start-2 max-[899px]:flex max-[899px]:gap-1.5 max-[899px]:overflow-x-auto max-[899px]:pb-0.5 min-[900px]:mt-0">
            @foreach ([
                ['admin.dashboard', 'Dashboard', 'admin.dashboard'],
                ['admin.profile', 'Profil usaha', 'admin.profile'],
                ['admin.categories', 'Kategori menu', 'admin.categories*'],
                ['admin.menu.index', 'Menu', 'admin.menu.*'],
                ['admin.gallery', 'Galeri', 'admin.gallery*'],
                ['admin.contact', 'Lokasi & kontak', 'admin.contact*'],
            ] as [$route, $label, $pattern])
                @php($active = request()->routeIs($pattern))
                <a href="{{ route($route) }}"
                   class="flex items-center gap-2.5 whitespace-nowrap rounded-[10px] px-3 py-2 text-sm transition-colors
                          {{ $active
                              ? 'bg-white/12 font-semibold text-white'
                              : 'font-medium text-on-dark-muted hover:bg-white/7 hover:text-white' }}">{{ $label }}</a>
            @endforeach
        </nav>
    </aside>

    <div class="min-w-0 p-4 min-[640px]:p-5 min-[900px]:p-8">
        @if (session('status'))
            <div class="mb-5 rounded-ctl border border-[#CFE0D3] bg-accent-soft px-4 py-3 text-sm font-semibold text-accent">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-5 rounded-ctl border border-[#F0CFC8] bg-[#FBEDEA] px-4 py-3 text-sm font-semibold text-[#A33A2A]">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>