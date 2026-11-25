# Pajak Coffee

Website company profile untuk Pajak Coffee Dumai, dibuat dengan Laravel 13 dan Tailwind CSS. Sudah dilengkapi panel admin untuk mengubah profil usaha, kategori, menu, galeri foto, dan informasi lokasi.

- **Kebutuhan**: PHP 8.3+, Composer, Node.js.
- **Instalasi**: jalankan `composer install`, `npm install`, `cp .env.example .env`, `php artisan key:generate`, `php artisan migrate --seed`, lalu `npm run build` (atau cukup `composer setup` untuk menjalankan semuanya).
- **Menjalankan**: gunakan `composer serve` untuk `localhost:8000` atau `composer serve:lan` supaya bisa dibuka dari HP di jaringan yang sama; jalankan `npm run dev` kalau sedang mengubah CSS.
- **Login admin**: buka `/login` dengan email `admin@pajakcoffee.test` dan password `password`.

Catatan: foto dan teks yang tampil saat ini masih data contoh, silakan ganti lewat panel admin.
