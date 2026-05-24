@extends('layouts.app')

@section('title', 'Home - Selamat Datang')

@section('content')

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">

        <div class="flex-1 space-y-8">

            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                #1 Event Platform
            </span>

            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan
                <span class="text-indigo-600">
                    Tiket Event
                </span>
                Impianmu.
            </h1>

            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi,
                semua ada di genggamanmu.
            </p>

            <div class="flex gap-4">

                <a
                    href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:scale-105 transition-transform"
                >
                    Mulai Jelajah
                </a>

            </div>

        </div>

        <div class="flex-1">

            <img
                src="assets/concert.png"
                alt="Concert"
                class="rounded-[2rem] shadow-2xl w-full"
            >

        </div>

    </section>

    <!-- Categories Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">

        <div class="text-center mb-12">

            <h2 class="text-4xl font-extrabold mb-4 text-slate-800">
                Kategori Event
            </h2>

            <p class="text-slate-500 text-lg">
                Temukan berbagai kategori event menarik di AmikomEventHub
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

            @foreach($categories as $category)

                <div
                    class="bg-white rounded-3xl shadow-lg p-8 text-center hover:shadow-2xl transition-all"
                >

                    <div
                        class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold"
                    >
                        {{ substr($category->name, 0, 1) }}
                    </div>

                    <h3 class="text-xl font-bold text-slate-800">
                        {{ $category->name }}
                    </h3>

                </div>

            @endforeach

        </div>

    </section>

    <!-- Partners Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">

        <div class="text-center mb-12">

            <h2 class="text-4xl font-extrabold mb-4 text-slate-800">
                Partner Kami
            </h2>

            <p class="text-slate-500 text-lg">
                Partner yang mendukung platform AmikomEventHub
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

            @foreach($partners as $partner)

                <div
                    class="bg-white rounded-3xl shadow-lg p-8 text-center hover:shadow-2xl transition-all"
                >

                    @if($partner->logo_url)

                        <img
                            src="{{ asset('uploads/partners/' . $partner->logo_url) }}"
                            alt="{{ $partner->name }}"
                            class="w-24 h-24 object-contain mx-auto mb-4"
                        >

                    @else

                        <div
                            class="w-24 h-24 bg-slate-100 rounded-full mx-auto mb-4 flex items-center justify-center text-slate-400"
                        >
                            No Logo
                        </div>

                    @endif

                    <h3 class="text-xl font-bold text-slate-800">
                        {{ $partner->name }}
                    </h3>

                </div>

            @endforeach

        </div>

    </section>

@endsection