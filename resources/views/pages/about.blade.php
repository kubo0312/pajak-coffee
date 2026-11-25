@extends('layouts.app')

@section('title', 'Tentang - '.$profile->name)

@section('content')
<section class="page is-active">
  <div class="wrap page-head">
    <h1>Tentang {{ $profile->name }}</h1>
    <p>{{ $profile->about }}</p>
  </div>

  <div class="wrap section-tight">
    <div class="split">
      <figure class="split-figure">
        <img src="{{ asset('assets/hero-barista.jpg') }}" alt="Barista {{ $profile->name }} sedang menuang susu" loading="lazy">
      </figure>
      <div class="prose">
        <h2>Berawal dari satu mesin espresso</h2>
        <p>{{ $profile->name }} dibuka pada 2021 oleh pemilik yang sebelumnya berjualan kopi keliling. Nama "pajak" dipakai sebagai lelucon warga sekitar: setiap sore orang merasa wajib mampir dulu sebelum pulang.</p>
        <p>Sampai sekarang kedai masih dikelola keluarga, dengan enam meja di dalam dan empat meja di teras. Menunya tidak banyak, karena dapur hanya sanggup mengerjakan yang benar-benar segar.</p>
      </div>
    </div>
  </div>

  <div class="wrap section-tight">
    <div class="split">
      <div class="prose">
        <h2>Visi</h2>
        <p>{{ $profile->vision }}</p>

        <h2 style="margin-top:36px">Misi</h2>
        <ul class="list-check">
          @foreach ($profile->mission as $i => $point)
            <li><span class="tick">{{ $i + 1 }}</span><span>{{ $point }}</span></li>
          @endforeach
        </ul>
      </div>
      <figure class="split-figure">
        <img src="{{ asset('assets/galeri-interior.jpg') }}" alt="Interior {{ $profile->name }} dengan meja kayu" loading="lazy">
      </figure>
    </div>
  </div>
</section>
@endsection