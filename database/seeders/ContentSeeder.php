<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Menu;
use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Kopi', 'slug' => 'kopi', 'sort_order' => 1],
            ['name' => 'Kopi Susu', 'slug' => 'kopi-susu', 'sort_order' => 2],
            ['name' => 'Makanan', 'slug' => 'makanan', 'sort_order' => 3],
        ])->mapWithKeys(fn ($row) => [
            $row['slug'] => Category::updateOrCreate(['slug' => $row['slug']], $row),
        ]);

        $menus = [
            ['Kopi', 'Espresso', 15000, 'Satu shot, 30 ml. Robusta Riau, pahit bersih.', 'assets/espresso.jpg', true],
            ['Kopi', 'Kopi Tubruk', 10000, 'Kopi bubuk diseduh langsung di gelas, tanpa filter.', 'assets/kopi-tubruk.jpg', true],
            ['Kopi Susu', 'Es Kopi Susu', 18000, 'Espresso ganda, susu segar, gula aren cair.', 'assets/iced-latte.jpg', true],
            ['Kopi Susu', 'Cappuccino', 22000, 'Espresso, susu steam, busa tebal. Bisa tanpa gula.', 'assets/latte-art.jpg', false],
            ['Makanan', 'Pisang Goreng', 15000, 'Enam potong, digoreng setelah dipesan.', 'assets/pisang-goreng.jpg', false],
            ['Makanan', 'Roti Bakar', 15000, 'Pilihan isi: cokelat, keju, atau srikaya.', 'assets/roti-bakar.jpg', false],
        ];

        foreach ($menus as $i => [$category, $name, $price, $desc, $image, $featured]) {
            Menu::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id' => $categories[$category === 'Kopi' ? 'kopi' : ($category === 'Kopi Susu' ? 'kopi-susu' : 'makanan')]->id,
                    'name' => $name,
                    'price' => $price,
                    'description' => $desc,
                    'image' => $image,
                    'is_available' => $name !== 'Pisang Goreng',
                    'is_featured' => $featured,
                    'sort_order' => $i + 1,
                ]
            );
        }

        $gallery = [
            ['assets/galeri-interior.jpg', 'Ruang dalam, enam meja kayu'],
            ['assets/galeri-sore.jpg', 'Sore hujan, teras paling penuh'],
            ['assets/galeri-menu.jpg', 'Menu camilan yang disiapkan pagi'],
            ['assets/hero-barista.jpg', 'Satu pesanan, satu penyeduhan'],
            ['assets/roti-bakar-2.jpg', 'Roti bakar, isi cokelat dan keju'],
            ['assets/latte-art.jpg', 'Cappuccino, 22.000'],
        ];

        foreach ($gallery as $i => [$image, $caption]) {
            GalleryItem::updateOrCreate(
                ['image' => $image],
                ['caption' => $caption, 'sort_order' => $i + 1]
            );
        }

        SiteProfile::query()->updateOrCreate(['id' => 1], [
            'name' => 'Pajak Coffee',
            'brand_mark' => 'PC',
            'tagline' => 'Kedai kopi di Dumai Kota',
            'hero_title' => 'Kopi yang menemani malam di Dumai.',
            'hero_lead' => 'Kopi tubruk, es kopi susu, dan camilan hangat. Buka setiap hari sampai tengah malam di Rimba Sekampung.',
            'about' => 'Kedai kecil di Jl. Sultan Hasanuddin yang dibuka sejak 2021. Kopi diseduh satu per satu, bukan dari mesin otomatis.',
            'vision' => 'Menjadi kedai kopi yang paling dekat dengan warga Dumai Kota, dalam arti jarak maupun harga.',
            'mission' => [
                'Memakai biji kopi robusta dari petani Riau dan Sumatera Barat.',
                'Menjaga harga minuman di bawah 25.000 supaya bisa diminum tiap hari.',
                'Menyediakan tempat duduk yang nyaman untuk belajar dan kerja sampai tengah malam.',
            ],
            'address' => 'Jl. Sultan Hasanuddin, Rimba Sekampung, Kec. Dumai Kota, Kota Dumai, Riau 28812',
            'hours' => [
                ['label' => 'Senin - Jumat', 'value' => '10.00 - 24.00'],
                ['label' => 'Sabtu', 'value' => '10.00 - 01.00'],
                ['label' => 'Minggu', 'value' => '12.00 - 24.00'],
            ],
            'phone' => '0812-6600-2451',
            'whatsapp' => '6281266002451',
            'instagram' => 'pajakcoffee.dumai',
            'map_query' => 'Jl. Sultan Hasanuddin, Rimba Sekampung, Dumai',
        ]);

        // akun admin untuk login
        User::updateOrCreate(
            ['email' => 'admin@pajakcoffee.test'],
            ['name' => 'Admin Pajak Coffee', 'password' => 'password']
        );
    }
}