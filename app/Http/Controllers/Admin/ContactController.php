<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\SiteProfile;

class ContactController extends Controller
{
    public function edit()
    {
        return view('admin.contact.edit', ['site' => SiteProfile::current()]);
    }

    public function update(ContactRequest $request)
    {
        $profile = SiteProfile::current();
        $data = $request->validated();

        $data['hours'] = $this->hours($data['hours']);

        $profile->update($data);

        return redirect()->route('admin.contact')->with('status', 'Lokasi dan kontak diperbarui.');
    }

    /**
     * Format textarea: satu baris = satu baris jam buka.
     * "Senin - Jumat | 10.00 - 24.00"
     */
    private function hours(string $text): array
    {
        $rows = [];

        foreach (preg_split('/\r\n|\r|\n/', $text) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            [$label, $value] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');

            if ($value === '') {
                $label = 'Jam buka';
                $value = $line;
            }

            $rows[] = ['label' => $label, 'value' => $value];
        }

        return $rows;
    }
}