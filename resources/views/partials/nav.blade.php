@php($navLinks = [
    ['home', 'Beranda', 'home'],
    ['about', 'Tentang', 'about'],
    ['menu', 'Menu', 'menu'],
    ['gallery', 'Galeri', 'gallery'],
    ['contact', 'Lokasi & Kontak', 'contact'],
])

<header class="sticky top-0 z-40 h-[68px] border-b border-line bg-canvas/90 backdrop-blur-md">
    <div class="mx-auto flex h-full w-full max-w-page items-center gap-8 px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-[1.0625rem] font-extrabold tracking-[-.03em]">
            <span class="grid size-[30px] place-items-center rounded-[9px] bg-accent text-[.8125rem] font-extrabold leading-none tracking-normal text-white">{{ $profile->brand_mark }}</span>
            {{ $profile->name }}
        </a>

        <button id="navToggle" type="button" aria-expanded="false" aria-controls="navLinks"
                class="ml-auto rounded-ctl border border-line px-3 py-2 text-sm font-semibold sm:hidden">Menu</button>

        <nav id="navLinks" class="ml-auto hidden gap-[26px] text-sm font-medium sm:flex">
            @foreach ($navLinks as [$route, $label, $key])
                <a href="{{ route($route) }}"
                   @if (request()->routeIs($key)) aria-current="page" @endif
                   class="border-b-2 border-transparent py-1.5 text-muted transition-colors hover:text-ink aria-[current=page]:border-accent aria-[current=page]:text-ink">{{ $label }}</a>
            @endforeach

            @auth
                <a href="{{ route('admin.dashboard') }}"
                   class="ml-1.5 rounded-ctl border border-line px-3.5 py-2 font-semibold text-muted transition-colors hover:border-border-hover hover:bg-surface hover:text-ink">Admin</a>
            @else
                <a href="{{ route('login') }}"
                   class="ml-1.5 rounded-ctl border border-line px-3.5 py-2 font-semibold text-muted transition-colors hover:border-border-hover hover:bg-surface hover:text-ink">Masuk admin</a>
            @endauth
        </nav>
    </div>
</header>
