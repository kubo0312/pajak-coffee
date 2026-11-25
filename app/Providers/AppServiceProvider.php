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
        $profile = SiteProfile::firstOrCreate([], [
            'name' => 'Pajak Coffee',
            'brand_mark' => 'PC',
            'tagline' => 'Kedai kopi di Dumai Kota',
            'hero_title' => 'Kopi yang menemani malam di Dumai.',
            'address' => 'Jl. Sultan Hasanuddin, Rimba Sekampung, Dumai Kota',
            'hours' => [],
            'mission' => [],
        ]);

        View::share('profile', $profile);
    }
}
