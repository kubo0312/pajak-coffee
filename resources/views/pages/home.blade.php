@extends('layouts.app')

@section('title', $profile->name.' - '.$profile->tagline)

@section('content')
<section class="page is-active">
  <div class="wrap hero">
    <div class="hero-grid">
      <div>
        <p class="eyebrow">{{ $profile->tagline }}</p>
        <h1>{{ $profile->hero_title }}</h1>
        <p class="lead">{{ $profile->hero_lead }}</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="{{ route('menu') }}">Lihat menu</a>
          <a class="btn btn-ghost" href="{{ route('contact') }}">Buka lokasi</a>
        </div>
        <div class="hero-facts">
          <div><span>Alamat</span><strong>Jl. Sultan Hasanuddin</strong></div>
          <div><span>Jam buka</span><strong>{{ $profile->hours[0]['value'] ?? '10.00 - 24.00' }}</strong></div>
          <div><span>Tempat duduk</span><strong>Indoor &amp; teras</strong></div>
        </div>
      </div>
      <figure class="hero-figure">
        <img src="{{ asset('assets/espresso.jpg') }}" alt="Secangkir espresso di meja kayu {{ $profile->name }}" width="1600" height="2000">
        <figcaption>Espresso · Rp{{ number_format($featured->firstWhere('name', 'Espresso')?->price ?? 15000, 0, ',', '.') }}</figcaption>
      </figure>
    </div>
  </div>

  <div class="wrap section-tight">
    <div class="section-head">
      <div>
        <h2>Yang paling sering dipesan</h2>
        <p class="muted small" style="margin-top:8px">Dari {{ $menuCount }} menu yang tersedia, ini tiga yang paling sering keluar.</p>
      </div>
      <a class="btn btn-ghost" href="{{ route('menu') }}">Semua menu</a>
    </div>

    <div class="featured">
      @foreach ($featured as $menu)
        <article class="card {{ $loop->first ? 'card--flagship' : 'card--small' }}">
          <div class="card-img"><img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" loading="lazy"></div>
          <div class="card-body">
            <div class="row">
              <h3 @if (! $loop->first) style="font-size:1rem" @endif>{{ $menu->name }}</h3>
              <span class="price">{{ $menu->price_label }}</span>
            </div>
            <p>{{ $menu->description }}</p>
          </div>
        </article>
      @endforeach
    </div>
  </div>

  <div class="wrap section-tight">
    <div class="band">
      <div>
        <h2>Ngopi sampai tengah malam.</h2>
        <p>{{ $profile->name }} buka setiap hari, termasuk Minggu. Jam paling ramai pukul 20.00 sampai 23.00.</p>
        <div class="hero-actions" style="margin-top:26px">
          <a class="btn btn-light" href="{{ route('contact') }}">Petunjuk arah</a>
        </div>
      </div>
      <div class="hours">
        @foreach ($profile->hours as $hour)
          <div><span>{{ $hour['label'] }}</span><strong>{{ $hour['value'] }}</strong></div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection