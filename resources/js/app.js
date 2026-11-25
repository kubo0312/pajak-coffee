const toggle = document.getElementById('navToggle');
const links = document.getElementById('navLinks');

if (toggle && links) {
  toggle.addEventListener('click', () => {
    const open = links.toggleAttribute('data-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });
}

const modal = document.getElementById('modal');
const mImg = document.getElementById('modalImg');
const mCap = document.getElementById('modalCap');

if (modal && mImg) {
  const closeModal = () => {
    modal.classList.add('hidden');
    modal.classList.remove('grid');
    mImg.src = '';
  };

  document.querySelectorAll('#gallery button[data-full]').forEach((btn) => {
    btn.addEventListener('click', () => {
      mImg.src = btn.dataset.full;
      mImg.alt = btn.dataset.cap || '';
      if (mCap) mCap.textContent = btn.dataset.cap || '';
      modal.classList.remove('hidden');
      modal.classList.add('grid');
    });
  });

  const closeBtn = document.getElementById('modalClose');
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
}
