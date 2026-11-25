<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Satu baris saja: profil usaha yang dipakai seluruh halaman publik.
        Schema::create('site_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand_mark', 4)->default('PC');
            $table->string('tagline')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_lead', 500)->nullable();
            $table->text('about')->nullable();
            $table->text('vision')->nullable();
            $table->json('mission')->nullable();        // array<string>
            $table->string('address')->nullable();
            $table->json('hours')->nullable();          // [['label' => 'Senin - Jumat', 'value' => '10.00 - 24.00'], ...]
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('map_query')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_profiles');
    }
};