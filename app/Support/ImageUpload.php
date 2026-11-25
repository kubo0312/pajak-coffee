<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUpload
{
    /**
     * Simpan file ke public/uploads dan kembalikan path relatif
     * (contoh: "uploads/es-kopi-susu-a1b2c3.jpg").
     */
    public static function store(?UploadedFile $file, string $folder = 'uploads'): ?string
    {
        if (! $file) {
            return null;
        }

        $base = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'foto';
        $ext = Str::lower($file->getClientOriginalExtension() ?: 'jpg');
        $name = $base.'-'.Str::lower(Str::random(6)).'.'.$ext;

        $file->move(public_path($folder), $name);

        return $folder.'/'.$name;
    }

    /**
     * Hapus file lama, tapi HANYA kalau memang hasil upload
     * (path diawali "uploads/"). Foto contoh di assets/ tidak disentuh.
     */
    public static function delete(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/')) {
            return;
        }

        $full = public_path($path);

        if (is_file($full)) {
            @unlink($full);
        }
    }
}