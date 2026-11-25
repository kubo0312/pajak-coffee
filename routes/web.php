<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman publik (company profile)
|--------------------------------------------------------------------------
*/
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/tentang', 'about')->name('about');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/galeri', 'gallery')->name('gallery');
    Route::get('/lokasi', 'contact')->name('contact');
});

/*
|--------------------------------------------------------------------------
| Autentikasi admin (session based, tanpa Breeze/Jetstream)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:6,1');
});

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Area admin
|--------------------------------------------------------------------------
| Dashboard dan CRUD menu sudah jalan. Section lain masih kerangka:
| route-nya ada, view-nya placeholder, tinggal diisi.
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('menu', AdminMenuController::class)->except(['show']);

    // Kategori
    Route::get('kategori', [CategoryController::class, 'index'])->name('categories');
    Route::get('kategori/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('kategori', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('kategori/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('kategori/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('kategori/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Galeri
    Route::get('galeri', [GalleryController::class, 'index'])->name('gallery');
    Route::get('galeri/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('galeri', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('galeri/{item}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('galeri/{item}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('galeri/{item}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Profil usaha + lokasi/kontak
    Route::get('profil', [ProfileController::class, 'edit'])->name('profile');
    Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('kontak', [ContactController::class, 'edit'])->name('contact');
    Route::put('kontak', [ContactController::class, 'update'])->name('contact.update');
});
