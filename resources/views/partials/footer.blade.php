<footer class="footer">
  <div class="wrap">
    <div class="footer-grid">
      <div>
        <div class="brand"><span class="mark">{{ $profile->brand_mark }}</span> {{ $profile->name }}</div>
        <p>Kedai kopi di {{ $profile->address }}. Buka setiap hari sampai tengah malam.</p>
      </div>
      <div>
        <h3>Halaman</h3>
        <div class="foot-links">
          <a href="{{ route('about') }}">Tentang</a>
          <a href="{{ route('menu') }}">Menu</a>
          <a href="{{ route('gallery') }}">Galeri</a>
          <a href="{{ route('contact') }}">Lokasi &amp; Kontak</a>
        </div>
      </div>
      <div>
        <h3>Kontak</h3>
        <div class="foot-links">
          @if ($profile->phone)<a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}">{{ $profile->phone }}</a>@endif
          @if ($profile->whatsapp)<a href="https://wa.me/{{ $profile->whatsapp }}">WhatsApp</a>@endif
          @if ($profile->instagram)<a href="https://instagram.com/{{ $profile->instagram }}">@{{ $profile->instagram }}</a>@endif
        </div>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© {{ date('Y') }} {{ $profile->name }} Dumai</span>
      <span>Website company profile, tugas Metodologi Penelitian</span>
    </div>
  </div>
</footer>