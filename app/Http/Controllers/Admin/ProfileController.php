<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $site = SiteProfile::first();
        $missionText = implode("\n", $site->mission ?? []);

        return view('admin.profile.edit', [
            'site' => $site,
            'missionText' => $missionText,
        ]);
    }

    public function update(Request $request)
    {
        $profile = SiteProfile::first();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'brand_mark' => ['required', 'string', 'max:4'],
            'tagline' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:160'],
            'hero_lead' => ['required', 'string', 'max:500'],
            'about' => ['required', 'string', 'max:1000'],
            'vision' => ['required', 'string', 'max:500'],
            'mission' => ['required', 'string', 'max:1000'],
        ]);

        $data['mission'] = $this->lines($data['mission']);

        $profile->update($data);

        return redirect()->route('admin.profile')->with('status', 'Profil usaha diperbarui.');
    }

    private function lines($text)
    {
        $lines = preg_split('/\r\n|\r|\n/', $text);

        return array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));
    }
}
