<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/lokasi', [PageController::class, 'contact'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:6,1');
});

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('menu/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

    Route::get('kategori', [CategoryController::class, 'index'])->name('categories');
    Route::get('kategori/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('kategori', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('kategori/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('kategori/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('kategori/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('galeri', [GalleryController::class, 'index'])->name('gallery');
    Route::get('galeri/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('galeri', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('galeri/{item}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('galeri/{item}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('galeri/{item}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('profil', [ProfileController::class, 'edit'])->name('profile');
    Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('kontak', [ContactController::class, 'edit'])->name('contact');
    Route::put('kontak', [ContactController::class, 'update'])->name('contact.update');
});
