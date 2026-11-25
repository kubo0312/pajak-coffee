# Pajak Coffee - Laravel 13

Website company profile Pajak Coffee Dumai. Design (warna, tipografi, spacing,
komponen) diambil langsung dari mockup statis `../pajak-coffee-ui` supaya hasil
akhirnya identik, bukan redesign.

## Cara jalanin

### Buka di jaringan lokal (server + Vite sekaligus)

```bash
cd D:/Other/People/Robinus/pajak-coffee
composer serve:net
```

Perintah itu menjalankan dua proses berbarengan:

| Proses | Alamat |
|---|---|
| Laravel (`php artisan serve --host=0.0.0.0 --port=8000`) | http://<ip-lan>:8000 |
| Vite dev server (`npm run dev`, port 5173) | http://<ip-lan>:5173 |

Beberapa baris pertama akan mencetak IP LAN yang bisa dibuka dari HP atau
laptop lain. Ctrl+C untuk menghentikan keduanya (concurrently pakai
`--kill-others`, jadi satu mati semua ikut mati).

Kalau di Git Bash `composer` rewel (`Could not open input file`), pakai
bentuk panjangnya:

```bash
php "C:/ProgramData/ComposerSetup/bin/composer.phar" serve:net
```

Perangkat lain tidak bisa connect? Izinkan port 8000 di Windows Firewall
untuk `php.exe` (butuh hak admin), lalu cek lagi. Kalau IP yang dipakai Vite
salah (misal kena adapter VPN/WARP), timpa lewat
`VITE_HMR_HOST=192.168.1.10 npm run dev`.

### Lokal saja

```bash
php artisan serve --port=8000   # tanpa Vite, pakai CSS fallback di public/css
composer dev                    # bawaan Laravel: server + queue + log + vite
```

### Login admin

http://127.0.0.1:8000/login
- email: `admin@pajakcoffee.test`
- password: `password`

Database: SQLite di `database/database.sqlite` (tidak perlu MySQL).
Reset isi database: `php artisan migrate:fresh --seed`

Build CSS untuk produksi: `npm run build` (hasilnya di `public/build`).

### Catatan CSS (dev vs fallback)

Blade memakai `partials/styles.blade.php`:

- kalau `public/hot` ada atau `public/build/manifest.json` sudah dibangun,
  halaman memakai `@vite` (CSS dari Vite, HMR jalan);
- kalau tidak ada keduanya, halaman memakai `public/css/site.css` +
  `public/css/app-extras.css` supaya tetap tampil tanpa Vite.

Sumber kebenaran CSS ada di `resources/css/`. File di `public/css/` cuma
salinan otomatis dari `bin/sync-design.sh`.

## Status

| Bagian | Status |
|---|---|
| Beranda, Tentang, Menu, Galeri, Lokasi & Kontak | jalan, semua data dari database |
| Filter kategori di halaman Menu | jalan lewat query string (`/menu?kategori=kopi-susu`) |
| Login / logout admin | jalan (session auth bawaan Laravel, tanpa Breeze) |
| Dashboard admin | jalan, angka statistik dihitung dari database |
| CRUD menu | jalan: tambah, ubah, hapus, status tersedia, unggulan, upload foto |
| CRUD kategori | jalan, slug otomatis, kategori yang masih dipakai menu tidak bisa dihapus |
| CRUD galeri | jalan, upload foto (JPG/PNG/WebP, maks 2 MB), foto lama otomatis dibersihkan |
| Profil usaha | jalan: nama, inisial logo, tagline, judul beranda, tentang, visi, misi |
| Lokasi & kontak | jalan: alamat, jam buka, telepon, WhatsApp, Instagram, pencarian peta |

## Struktur

```
app/Http/Controllers/PageController.php      halaman publik
app/Http/Controllers/AuthController.php      login/logout
app/Http/Controllers/Admin/                  Dashboard, Menu, Category, Gallery, Profile, Contact
app/Http/Requests/                           validasi form (Menu/Category/Gallery/Profile/Contact)
app/Models/                                  Category, Menu, GalleryItem, SiteProfile
app/Support/ImageUpload.php                  simpan/hapus file upload di public/uploads
database/migrations/2026_11_20_*             tabel konten + profil
database/seeders/ContentSeeder.php           isi data awal dari mockup (idempotent)
resources/views/layouts/app.blade.php        layout publik (nav + footer)
resources/views/layouts/admin.blade.php      layout admin (sidebar)
resources/views/pages/                       beranda, tentang, menu, galeri, lokasi
resources/views/admin/                       dashboard, menu, category, gallery, profile, contact
resources/css/site.css                       HASIL EKSTRAK dari mockup, jangan diedit tangan
resources/css/app-extras.css                 tambahan khusus Laravel (sidebar <a>, flash, preview)
resources/css/app.css                        entry Vite: @import dua file di atas
resources/views/partials/styles.blade.php    @vite kalau ada hot/manifest, fallback kalau tidak
vite.config.js                               listen 0.0.0.0:5173, HMR pakai IP LAN
public/css/                                  salinan otomatis resources/css (fallback)
public/js/site.js                            menu mobile + lightbox galeri
public/assets/                               foto contoh, disalin dari mockup
public/uploads/                              hasil upload admin
public/build/                                hasil npm run build
bin/sync-design.sh                           tarik CSS + foto dari mockup
bin/net-info.php                             cetak IP LAN saat composer serve:net
```

## Catatan data

- `price` disimpan sebagai integer rupiah (`18000`), ditampilkan lewat
  accessor `price_label` (`Rp18.000`) dan `price_plain` (`18.000`).
- `SiteProfile::current()` selalu mengembalikan satu baris profil; dipakai
  nav, footer, dan semua halaman lewat view composer di `AppServiceProvider`.
- Dua field disimpan sebagai JSON dan diedit lewat textarea:
  - `mission`: satu poin per baris.
  - `hours`: satu baris per jadwal, format `keterangan | jam`.
- Upload masuk ke `public/uploads`; file lama dihapus hanya kalau path-nya
  memang diawali `uploads/`. Foto contoh di `assets/` tidak pernah disentuh.

## Design

Mockup di `../pajak-coffee-ui` sudah final. Kalau nanti masih ada revisi di
sana, sinkron ulang tanpa copy manual:

```bash
bash bin/sync-design.sh
```

Script itu mengekstrak blok `<style>` dari `pajak-coffee-ui/index.html` ke
`public/css/site.css` dan menyalin ulang folder `assets`. Jadi `site.css`
selalu cermin dari mockup; perubahan manual taruh di `app-extras.css`.

## Yang belum ada (sengaja)

- Editor teks kaya (sekarang textarea biasa)
- Urutkan foto/menu lewat drag and drop (sekarang isi nomor urut)
- Manajemen user admin (baru satu akun dari seeder, belum ada ganti password)
- Halaman 404 custom
- Test otomatis (PHPUnit/Pest)
- Build asset (Vite tidak dipakai; CSS/JS disajikan langsung dari `public/`)