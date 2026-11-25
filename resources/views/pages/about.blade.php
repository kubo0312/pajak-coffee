@extends('layouts.app')

@section('title', 'Tentang - '.$profile->name)

@section('content')
<section class="animate-rise">
    <div class="mx-auto w-full max-w-page px-6 pb-2 pt-16 max-[639px]:pt-10">
        <h1>Tentang {{ $profile->name }}</h1>
        <p class="mt-3 max-w-[52ch] text-muted">{{ $profile->about }}</p>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="grid items-center gap-14 max-[959px]:gap-8 min-[960px]:grid-cols-2">
            <figure class="aspect-[5/4] overflow-hidden rounded-card shadow-card">
                <img src="{{ asset('assets/hero-barista.jpg') }}" alt="Barista {{ $profile->name }} sedang menuang susu" loading="lazy">
            </figure>

            <div>
                <h2>Berawal dari satu mesin espresso</h2>
                <p class="mt-3.5 max-w-[56ch] text-muted">{{ $profile->name }} dibuka pada 2021 oleh pemilik yang sebelumnya berjualan kopi keliling. Nama "pajak" dipakai sebagai lelucon warga sekitar: setiap sore orang merasa wajib mampir dulu sebelum pulang.</p>
                <p class="mt-3.5 max-w-[56ch] text-muted">Sampai sekarang kedai masih dikelola keluarga, dengan enam meja di dalam dan empat meja di teras. Menunya tidak banyak, karena dapur hanya sanggup mengerjakan yang benar-benar segar.</p>
            </div>
        </div>
    </div>

    <div class="mx-auto w-full max-w-page px-6 py-14 max-[639px]:py-10">
        <div class="grid items-center gap-14 max-[959px]:gap-8 min-[960px]:grid-cols-2">
            <div>
                <h2>Visi</h2>
                <p class="mt-3.5 max-w-[56ch] text-muted">{{ $profile->vision }}</p>

                <h2 class="mt-9">Misi</h2>
                <ul class="mt-5 grid list-none gap-3 p-0">
                    @foreach ($profile->mission as $i => $point)
                        <li class="grid grid-cols-[22px_1fr] gap-3 text-[.9375rem]">
                            <span class="mt-0.5 grid size-[22px] place-items-center rounded-full bg-accent-soft text-xs font-extrabold text-accent">{{ $i + 1 }}</span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <figure class="aspect-[5/4] overflow-hidden rounded-card shadow-card">
                <img src="{{ asset('assets/galeri-interior.jpg') }}" alt="Interior {{ $profile->name }} dengan meja kayu" loading="lazy">
            </figure>
        </div>
    </div>
</section>
@endsection