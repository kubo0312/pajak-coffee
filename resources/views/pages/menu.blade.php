@extends('layouts.app')

@section('title', 'Menu - '.$profile->name)

@section('content')
<section class="page is-active">
  <div class="wrap page-head">
    <h1>Menu</h1>
    <p>Harga sudah termasuk pajak. Menu bertanda tersedia bisa langsung dipesan di kasir.</p>
  </div>

  <div class="wrap section-tight">
    <div class="filters" role="group" aria-label="Filter kategori menu">
      <a class="chip" href="{{ route('menu') }}" aria-pressed="{{ $activeCategory ? 'false' : 'true' }}">Semua</a>
      @foreach ($categories as $category)
        <a class="chip"
           href="{{ route('menu', ['kategori' => $category->slug]) }}"
           aria-pressed="{{ $activeCategory?->id === $category->id ? 'true' : 'false' }}">{{ $category->name }}</a>
      @endforeach
    </div>

    <div class="menu-grid" id="menuGrid">
      @forelse ($menus as $menu)
        <article class="card menu-item" data-cat="{{ $menu->category->slug }}">
          <div class="card-img"><img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" loading="lazy"></div>
          <div class="card-body">
            <div class="row">
              <h3 style="font-size:1.0625rem">{{ $menu->name }}</h3>
              <span class="price">{{ $menu->price_label }}</span>
            </div>
            <p>{{ $menu->description }}</p>
          </div>
        </article>
      @empty
        <p class="empty">Belum ada menu di kategori ini.</p>
      @endforelse
    </div>

    <p class="muted small" style="margin-top:24px">Punya alergi atau minta less sugar? Sebut saja ke kasir.</p>
  </div>
</section>
@endsection