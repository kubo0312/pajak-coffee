@if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
    {{-- Vite dev server atau hasil npm run build --}}
    @vite(['resources/css/app.css'])
@else
    {{-- Fallback: pakai CSS hasil salinan di public/css --}}
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-extras.css') }}">
@endif