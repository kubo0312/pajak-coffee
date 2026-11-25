@extends('layouts.app')

@section('title', 'Lokasi & Kontak - '.$profile->name)

@section('content')
<section class="page is-active">
  <div class="wrap page-head">
    <h1>Lokasi &amp; Kontak</h1>
    <p>Ada di {{ $profile->address }}, sekitar 400 meter dari Simpang Rimba Sekampung.</p>
  </div>

  <div class="wrap section-tight">
    <div class="loc-grid">
      <div>
        <div class="info-block">
          <h3>Alamat</h3>
          <p>{!! nl2br(e($profile->address)) !!}</p>
        </div>

        <div class="info-block">
          <h3>Jam operasional</h3>
          @foreach ($profile->hours as $hour)
            <p>{{ $hour['label'] }}: {{ $hour['value'] }}</p>
          @endforeach
        </div>

        <div class="info-block">
          <h3>Kontak</h3>
          @if ($profile->phone)
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}">Telepon: {{ $profile->phone }}</a>
          @endif
          @if ($profile->whatsapp)
            <a href="https://wa.me/{{ $profile->whatsapp }}">WhatsApp: {{ $profile->phone }}</a>
          @endif
          @if ($profile->instagram)
            <a href="https://instagram.com/{{ $profile->instagram }}">Instagram: {{ "@" }}{{ $profile->instagram }}</a>
          @endif
        </div>
      </div>

      <div class="map">
        <iframe title="Peta lokasi {{ $profile->name }}"
          loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          src="https://maps.google.com/maps?q={{ urlencode($profile->map_query) }}&z=16&output=embed"></iframe>
      </div>
    </div>
  </div>
</section>
@endsection
