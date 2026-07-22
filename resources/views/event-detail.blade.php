@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', $event->title)

@section('content')

<div class="max-w-5xl mx-auto px-6 py-20">

```
<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <!-- Hero Poster -->
    <div class="p-8">

        <img
            src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                ? asset('storage/' . $event->poster_path)
                : 'https://placehold.co/200x600' }}"
            alt="{{ $event->title }}"
            class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4]"
        >

    </div>

    <div class="px-8 pb-8">

        <!-- Kategori -->
        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-bold mb-4">
            {{ $event->category->name }}
        </span>

        <!-- Judul -->
        <h1 class="text-4xl font-extrabold text-slate-800 mb-4">
            {{ $event->title }}
        </h1>

        <!-- Deskripsi -->
        <p class="text-slate-500 leading-relaxed mb-8">
            {{ $event->description }}
        </p>

        <!-- Informasi Event -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">

            <div class="bg-slate-50 p-5 rounded-2xl">
                <p class="text-slate-400 text-sm mb-1">
                    Tanggal Event
                </p>

                <p class="font-bold text-slate-800">
                    📅 {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                </p>
            </div>

            <div class="bg-slate-50 p-5 rounded-2xl">
                <p class="text-slate-400 text-sm mb-1">
                    Lokasi Event
                </p>

                <p class="font-bold text-slate-800">
                    📍 {{ $event->location }}
                </p>
            </div>

            <div class="bg-slate-50 p-5 rounded-2xl">
                <p class="text-slate-400 text-sm mb-1">
                    Harga Tiket
                </p>

                <p class="font-bold text-indigo-600 text-xl">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-slate-50 p-5 rounded-2xl">
                <p class="text-slate-400 text-sm mb-1">
                    Ketersediaan Tiket
                </p>

                <p class="font-bold text-green-600">
                    {{ $event->stock }} Tiket Lagi!
                </p>
            </div>

        </div>

        <!-- Tombol -->
        <!-- Tombol -->
<div class="flex flex-wrap gap-4 mb-10">

    <a href="{{ url('checkout/' . $event->id) }}"
        class="bg-indigo-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition">

        Pesan Sekarang

    </a>

    <a href="{{ route('home') }}"
        class="bg-slate-100 text-slate-700 px-8 py-3 rounded-2xl font-bold hover:bg-slate-200 transition">

        Kembali

    </a>

</div>

<!-- Rating -->
<div class="bg-slate-50 rounded-2xl p-6 mb-8">

    <h2 class="text-2xl font-bold mb-3">
        ⭐ Rating Event
    </h2>

    <div class="flex items-center gap-4">

        <span class="text-4xl font-bold text-yellow-500">
            {{ $event->averageRating() ?? 0 }}
        </span>

        <div>

            <div class="text-yellow-400 text-xl">
                ★★★★★
            </div>

            <p class="text-slate-500">
                {{ $event->totalReviews() }} Review
            </p>

        </div>

    </div>

</div>

@auth

<div class="bg-white border rounded-2xl p-6 mb-8">

    <h2 class="text-2xl font-bold mb-4">
        Berikan Review
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('review.store', $event->id) }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="font-semibold">
                Rating
            </label>

            <select
                name="rating"
                class="w-full border rounded-xl p-3 mt-2"
                required>

                <option value="">Pilih Rating</option>
                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                <option value="4">⭐⭐⭐⭐ (4)</option>
                <option value="3">⭐⭐⭐ (3)</option>
                <option value="2">⭐⭐ (2)</option>
                <option value="1">⭐ (1)</option>

            </select>

        </div>

        <div class="mb-4">

            <label class="font-semibold">
                Review
            </label>

            <textarea
                name="review"
                rows="4"
                class="w-full border rounded-xl p-3 mt-2"
                placeholder="Tulis pengalaman Anda..."></textarea>

        </div>

        <button
            class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold">

            Kirim Review

        </button>

    </form>

</div>

@endauth

<!-- Daftar Review -->
<div class="bg-white rounded-2xl shadow-lg p-6 mt-8">

    <h2 class="text-2xl font-bold mb-6">
        Semua Review ({{ $event->totalReviews() }})
    </h2>

    @forelse($event->reviews as $review)

        <div class="border-b border-slate-200 py-5">

            <div class="flex justify-between items-center mb-2">

                <div>

                    <h4 class="font-bold text-slate-800">
                        {{ $review->user->name }}
                    </h4>

                    <p class="text-sm text-slate-400">
                        {{ $review->created_at->format('d M Y H:i') }}
                    </p>

                </div>

                <div class="text-yellow-400 text-lg">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $review->rating)

                            ★

                        @else

                            ☆

                        @endif

                    @endfor

                </div>

            </div>

            @if($review->review)

                <p class="text-slate-600 leading-relaxed">
                    {{ $review->review }}
                </p>

            @endif

        </div>

    @empty

        <div class="text-center py-10">

            <h3 class="text-xl font-semibold text-slate-500">
                Belum ada review
            </h3>

            <p class="text-slate-400 mt-2">
                Jadilah orang pertama yang memberikan penilaian untuk event ini.
            </p>

        </div>

    @endforelse

</div>

        </div>

    </div>

</div>
```

</div>

@endsection
