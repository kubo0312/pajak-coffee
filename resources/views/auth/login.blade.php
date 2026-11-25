<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk admin · {{ $profile->name }}</title>
<meta name="robots" content="noindex">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
@include('partials.styles')
</head>
<body data-mode="public">

<header class="nav">
  <div class="nav-in">
    <a class="brand" href="{{ route('home') }}"><span class="mark">{{ $profile->brand_mark }}</span> {{ $profile->name }}</a>
    <a class="nav-admin nav-site" href="{{ route('home') }}">Lihat website</a>
  </div>
</header>

<section class="page is-active">
  <div class="auth">
    <form class="auth-card" method="POST" action="{{ route('login') }}" autocomplete="off">
      @csrf
      <h2 style="font-size:1.5rem">Masuk admin</h2>
      <p class="muted small" style="margin-top:8px">Halaman ini hanya untuk pemilik kedai.</p>

      <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
        @error('email')<p class="err">{{ $message }}</p>@enderror
      </div>

      <div class="field">
        <label for="pass">Kata sandi</label>
        <input id="pass" name="password" type="password" placeholder="Minimal 8 karakter" required>
        <span class="hint">Lupa kata sandi? Hubungi pengembang website.</span>
      </div>

      <button class="btn btn-primary" style="width:100%;margin-top:22px" type="submit">Masuk</button>
    </form>
  </div>
</section>

</body>
</html>