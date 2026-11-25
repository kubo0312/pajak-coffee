/* Pajak Coffee - interaksi kecil yang tidak perlu server round-trip.
   Filter kategori menu sekarang server-side (?kategori=...), jadi tidak ada di sini. */
(function () {
  // menu mobile
  var toggle = document.getElementById('navToggle');
  var links = document.getElementById('navLinks');
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      var open = links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // lightbox galeri
  var modal = document.getElementById('modal');
  var mImg = document.getElementById('modalImg');
  var mCap = document.getElementById('modalCap');

  if (modal && mImg) {
    document.querySelectorAll('#gallery button[data-full]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        mImg.src = btn.dataset.full;
        mImg.alt = btn.dataset.cap || '';
        if (mCap) mCap.textContent = btn.dataset.cap || '';
        modal.classList.add('open');
      });
    });

    function closeModal() {
      modal.classList.remove('open');
      mImg.src = '';
    }

    var closeBtn = document.getElementById('modalClose');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
  }
})();