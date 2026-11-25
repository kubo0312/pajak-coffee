<header class="nav">
  <div class="nav-in">
    <a class="brand" href="{{ route('home') }}"><span class="mark">{{ $profile->brand_mark }}</span> {{ $profile->name }}</a>

    <button class="nav-toggle" id="navToggle" aria-expanded="false">Menu</button>

    <nav class="nav-links" id="navLinks">
      <a href="{{ route('home') }}" data-nav="home" @if (request()->routeIs('home')) aria-current="page" @endif>Beranda</a>
      <a href="{{ route('about') }}" data-nav="about" @if (request()->routeIs('about')) aria-current="page" @endif>Tentang</a>
      <a href="{{ route('menu') }}" data-nav="menu" @if (request()->routeIs('menu')) aria-current="page" @endif>Menu</a>
      <a href="{{ route('gallery') }}" data-nav="galeri" @if (request()->routeIs('gallery')) aria-current="page" @endif>Galeri</a>
      <a href="{{ route('contact') }}" data-nav="lokasi" @if (request()->routeIs('contact')) aria-current="page" @endif>Lokasi &amp; Kontak</a>

      @auth
        <a class="nav-admin" href="{{ route('admin.dashboard') }}">Admin</a>
      @else
        <a class="nav-admin" href="{{ route('login') }}">Masuk admin</a>
      @endauth
    </nav>

    <a class="nav-admin nav-site" href="{{ route('home') }}">Lihat website</a>
  </div>
</header>