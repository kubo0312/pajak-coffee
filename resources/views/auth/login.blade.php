<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk admin · {{ $profile->name }}</title>
<meta name="robots" content="noindex">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="sticky top-0 z-40 h-[68px] border-b border-line bg-canvas/90 backdrop-blur-md">
    <div class="mx-auto flex h-full w-full max-w-page items-center gap-8 px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-[1.0625rem] font-extrabold tracking-[-.03em]">
            <span class="grid size-[30px] place-items-center rounded-[9px] bg-accent text-[.8125rem] font-extrabold leading-none tracking-normal text-white">{{ $profile->brand_mark }}</span>
            {{ $profile->name }}
        </a>
        <a href="{{ route('home') }}"
           class="ml-auto rounded-ctl border border-line px-3.5 py-2 text-sm font-semibold text-muted transition-colors hover:border-border-hover hover:bg-surface hover:text-ink">Lihat website</a>
    </div>
</header>

<section class="grid place-items-center px-6 py-20">
    <form method="POST" action="{{ route('login') }}" autocomplete="off"
          class="w-full max-w-[400px] rounded-card border border-line bg-surface p-8 shadow-card max-[639px]:p-6">
        @csrf
        <h2 class="text-2xl">Masuk admin</h2>
        <p class="mt-2 text-sm text-muted">Halaman ini hanya untuk pemilik kedai.</p>

        <div class="mt-4 grid gap-2">
            <label for="email" class="text-sm font-semibold">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus
                   class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
            @error('email')<p class="text-[.8125rem] text-[#A33A2A]">{{ $message }}</p>@enderror
        </div>

        <div class="mt-4 grid gap-2">
            <label for="pass" class="text-sm font-semibold">Kata sandi</label>
            <input id="pass" name="password" type="password" placeholder="Minimal 8 karakter" required
                   class="h-11 w-full rounded-ctl border border-[#D7D3C8] bg-white px-3.5 text-[.9375rem] text-ink outline-none focus:border-accent focus:outline-2 focus:outline-accent">
            <span class="text-[.8125rem] text-muted">Lupa kata sandi? Hubungi pengembang website.</span>
        </div>

        <button type="submit"
                class="mt-[22px] inline-flex h-[46px] w-full items-center justify-center rounded-ctl border border-transparent bg-accent px-[22px] text-sm font-semibold text-white transition hover:bg-accent-hover active:translate-y-px">Masuk</button>
    </form>
</section>

</body>
</html>