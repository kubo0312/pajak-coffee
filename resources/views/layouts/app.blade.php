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

{{-- CSS hasil ekstrak dari mockup statis, ditambah sedikit penyesuaian di app-extras.css --}}
@include('partials.styles')
</head>
<body data-mode="public">

@include('partials.nav')

<main>
    @if (session('status'))
        <div class="wrap"><div class="flash">{{ session('status') }}</div></div>
    @endif
    @yield('content')
</main>

@include('partials.footer')

<div class="modal" id="modal" role="dialog" aria-modal="true" aria-label="Foto galeri">
  <button class="modal-close" id="modalClose" aria-label="Tutup">✕</button>
  <figure>
    <img id="modalImg" src="" alt="">
    <figcaption id="modalCap"></figcaption>
  </figure>
</div>

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>