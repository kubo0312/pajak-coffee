@extends('layouts.app')

@section('title', 'Galeri - '.$profile->name)

@section('content')
<section class="page is-active">
  <div class="wrap page-head">
    <h1>Galeri</h1>
    <p>Suasana kedai, meja, dan menu. Ketuk foto untuk melihat lebih besar.</p>
  </div>

  <div class="wrap section-tight">
    <div class="gallery" id="gallery">
      @forelse ($items as $item)
        <button data-full="{{ $item->image_url }}" data-cap="{{ $item->caption }}">
          <img src="{{ $item->image_url }}" alt="{{ $item->caption }}" loading="lazy">
        </button>
      @empty
        <p class="empty">Belum ada foto di galeri.</p>
      @endforelse
    </div>
  </div>
</section>
@endsection