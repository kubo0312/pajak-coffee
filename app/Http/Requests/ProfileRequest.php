<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:80'],
            'brand_mark' => ['required', 'string', 'max:4'],
            'tagline' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:160'],
            'hero_lead' => ['required', 'string', 'max:500'],
            'about' => ['required', 'string', 'max:1000'],
            'vision' => ['required', 'string', 'max:500'],
            'mission' => ['required', 'string', 'max:1000'],
        ];
    }
}