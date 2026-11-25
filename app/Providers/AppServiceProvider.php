<?php

namespace App\Providers;

use App\Models\SiteProfile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Profil usaha dipakai nav, footer, dan semua halaman.
        // Satu query per request, cukup untuk skala company profile.
        View::composer('*', function ($view) {
            if (! array_key_exists('profile', $view->getData())) {
                $view->with('profile', SiteProfile::current());
            }
        });
    }
}