<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteProfile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit()
    {
        $site = SiteProfile::first();
        $hoursText = collect($site->hours ?? [])
            ->map(fn ($row) => trim(($row['label'] ?? '').' | '.($row['value'] ?? '')))
            ->implode("\n");

        return view('admin.contact.edit', [
            'site' => $site,
            'hoursText' => $hoursText,
        ]);
    }

    public function update(Request $request)
    {
        $profile = SiteProfile::first();
        $data = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'instagram' => ['nullable', 'string', 'max:60'],
            'map_query' => ['required', 'string', 'max:255'],
        ]);

        $data['hours'] = $this->hours($data['hours']);

        $profile->update($data);

        return redirect()->route('admin.contact')->with('status', 'Lokasi dan kontak diperbarui.');
    }

    private function hours($text)
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
