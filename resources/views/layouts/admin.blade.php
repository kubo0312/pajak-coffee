<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Admin') · {{ $profile->name }}</title>
<meta name="robots" content="noindex">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">

@include('partials.styles')
</head>
<body data-mode="admin">

@include('partials.nav')

<section class="page is-active">
  <div class="admin">
    <aside class="side">
      <div class="brand"><span class="mark">{{ $profile->brand_mark }}</span> Admin</div>
      <nav>
        <a href="{{ route('admin.dashboard') }}" @if (request()->routeIs('admin.dashboard')) class="active" @endif>Dashboard</a>
        <a href="{{ route('admin.profile') }}" @if (request()->routeIs('admin.profile')) class="active" @endif>Profil usaha</a>
        <a href="{{ route('admin.categories') }}" @if (request()->routeIs('admin.categories')) class="active" @endif>Kategori menu</a>
        <a href="{{ route('admin.menu.index') }}" @if (request()->routeIs('admin.menu.*')) class="active" @endif>Menu</a>
        <a href="{{ route('admin.gallery') }}" @if (request()->routeIs('admin.gallery')) class="active" @endif>Galeri</a>
        <a href="{{ route('admin.contact') }}" @if (request()->routeIs('admin.contact')) class="active" @endif>Lokasi &amp; kontak</a>
      </nav>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout" type="submit">Keluar</button>
      </form>
    </aside>

    <div class="admin-main">
      @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
      @endif
      @if (session('error'))
        <div class="flash alert">{{ session('error') }}</div>
      @endif
      @yield('content')
    </div>
  </div>
</section>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>