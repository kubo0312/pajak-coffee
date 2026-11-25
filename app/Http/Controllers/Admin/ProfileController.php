<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\SiteProfile;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', ['site' => SiteProfile::current()]);
    }

    public function update(ProfileRequest $request)
    {
        $profile = SiteProfile::current();
        $data = $request->validated();

        $data['mission'] = $this->lines($data['mission']);

        $profile->update($data);

        return redirect()->route('admin.profile')->with('status', 'Profil usaha diperbarui.');
    }

    /** Textarea satu poin per baris -> array. */
    private function lines(string $text): array
    {
        $lines = preg_split('/\r\n|\r|\n/', $text);

        return array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));
    }
}