@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

@section('title', 'Home - Selamat Datang')

@section('content')

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row items-center gap-12">

    <div class="flex-1">

        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full font-bold text-sm mb-5">
            🎉 Platform Reservasi Event #1
        </span>

        <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight">

            Temukan &
            <span class="text-indigo-600">
                Pesan Tiket
            </span>

            Event Favoritmu

        </h1>

        <p class="text-slate-500 text-lg mt-6 leading-8 max-w-xl">

            Dari seminar teknologi,
            konser musik,
            workshop,
            hingga kompetisi nasional.
            Semua event dapat dipesan dengan mudah menggunakan Midtrans.

        </p>

        <div class="flex gap-4 mt-10">

            <a href="#events"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold">

                Jelajahi Event

            </a>

            <a href="{{ route('home') }}"
                class="border border-slate-300 hover:bg-slate-100 px-8 py-4 rounded-2xl font-bold">

                Beranda

            </a>

        </div>

    </div>

    <div class="flex-1">

        <img
            src="{{ asset('assets/concert.png') }}"
            class="rounded-3xl shadow-2xl w-full"
            onerror="this.src='https://placehold.co/700x600';">

    </div>

</section>


<!-- KATEGORI -->

<section class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">

        <h2 class="text-4xl font-extrabold">

            Kategori Event

        </h2>

        <p class="text-slate-500 mt-3">

            Pilih event berdasarkan kategori favoritmu.

        </p>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach($categories as $category)

        <div
            class="bg-white rounded-3xl shadow hover:shadow-xl transition p-8 text-center">

            <div
                class="w-16 h-16 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-2xl font-bold text-indigo-700">

                {{ strtoupper(substr($category->name,0,1)) }}

            </div>

            <h3 class="mt-5 text-xl font-bold">

                {{ $category->name }}

            </h3>

        </div>

        @endforeach

    </div>

</section>



<!-- PARTNER -->

<section class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">

        <h2 class="text-4xl font-extrabold">

            Partner Kami

        </h2>

        <p class="text-slate-500 mt-3">

            Berbagai partner yang mendukung AmikomEventHub.

        </p>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach($partners as $partner)

        <div
            class="bg-white rounded-3xl shadow hover:shadow-xl transition p-8 text-center">

            @if($partner->logo_url)

                <img
                    src="{{ asset('uploads/partners/'.$partner->logo_url) }}"
                    class="w-24 h-24 object-contain mx-auto">

            @else

                <div
                    class="w-24 h-24 rounded-full bg-slate-100 mx-auto flex items-center justify-center">

                    No Logo

                </div>

            @endif

            <h3 class="font-bold text-xl mt-6">

                {{ $partner->name }}

            </h3>

        </div>

        @endforeach

    </div>

</section>



<!-- EVENT -->

<section
id="events"
class="max-w-7xl mx-auto px-6 py-20">

<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-16">

    <div>
        <h2 class="text-5xl font-extrabold">
            Event Terbaru
        </h2>

        <p class="text-slate-500 mt-4">
            Temukan event menarik yang tersedia saat ini.
        </p>
    </div>

    <div class="flex flex-wrap gap-3 mt-8 lg:mt-0">

        <a href="{{ route('home') }}#events"
           class="px-5 py-3 rounded-xl font-semibold transition
           {{ request('category') ? 'bg-slate-200 text-slate-700 hover:bg-slate-300' : 'bg-indigo-600 text-white' }}">
            Semua Kategori
        </a>

        @foreach($categories as $category)

            <a href="{{ route('home',['category'=>$category->slug]) }}#events"
               class="px-5 py-3 rounded-xl font-semibold transition
               {{ request('category') == $category->slug
                    ? 'bg-indigo-600 text-white'
                    : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }}">

                {{ $category->name }}

            </a>

        @endforeach

    </div>

</div>

<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

@forelse($events as $event)

<div
class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">

<div class="h-64 overflow-hidden">

<img
src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
? asset('storage/'.$event->poster_path)
: 'https://placehold.co/700x500' }}"
class="w-full h-full object-cover hover:scale-110 transition duration-500">

</div>

<div class="p-6">

<span
class="inline-block bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full px-3 py-1">

{{ $event->category->name ?? 'Umum' }}

</span>

<h3
class="text-2xl font-bold mt-4">

{{ $event->title }}

</h3>

<p
class="text-slate-500 mt-3">

{{ Str::limit($event->description,120) }}

</p>

<div class="mt-5 space-y-2 text-sm">

<p>📍 {{ $event->location }}</p>

<p>
📅 {{ \Carbon\Carbon::parse($event->date)->format('d M Y H:i') }}
</p>
</div>

<div class="flex justify-between items-center mt-6">

    <div>

        <p class="text-2xl font-bold text-indigo-600">
            Rp {{ number_format($event->price,0,',','.') }}
        </p>

        @if($event->stock > 0)

            <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm">
                ✅ Stok tersedia ({{ $event->stock }})
            </span>

        @else

            <span class="inline-flex items-center gap-2 text-red-600 font-semibold text-sm">
                ❌ Tiket Habis
            </span>

        @endif

    </div>

</div>

<div class="grid grid-cols-2 gap-3 mt-6">

    <a
        href="{{ route('events.show',$event->id) }}"
        class="text-center bg-slate-200 hover:bg-slate-300 py-3 rounded-xl font-semibold transition">

        Lihat Detail

    </a>

    @if($event->stock > 0)

        <a
            href="{{ route('checkout.create',$event->id) }}"
            class="text-center bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">

            Pesan Tiket

        </a>

    @else

        <button
            disabled
            class="bg-gray-300 text-gray-500 rounded-xl py-3 font-semibold cursor-not-allowed">

            Tiket Habis

        </button>

    @endif

</div>

</div>

</div>

@empty

<div class="col-span-3">

    <div class="bg-white rounded-3xl shadow-lg p-12 text-center">

        <div class="text-7xl mb-6">
            🎫
        </div>

        <h3 class="text-3xl font-bold mb-4">

            Belum Ada Event

        </h3>

        <p class="text-slate-500">

            Saat ini belum ada event yang tersedia.
            Silakan kembali lagi nanti.

        </p>

    </div>

</div>

@endforelse

</div>

</section>
<!-- CTA -->

<section class="max-w-7xl mx-auto px-6 py-20">

    <div
        class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 rounded-3xl text-white p-12 shadow-2xl">

        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <div>

                <h2 class="text-4xl font-extrabold mb-5">

                    Ayo Ikuti Event Favoritmu!

                </h2>

                <p class="text-indigo-100 text-lg leading-8">

                    Pesan tiket secara online dengan cepat,
                    mudah, dan aman menggunakan Midtrans.
                    Jangan sampai kehabisan tiket event impianmu.

                </p>

                <div class="mt-8">

                    <a
                        href="#events"
                        class="bg-white text-indigo-700 px-8 py-4 rounded-2xl font-bold hover:bg-slate-100">

                        Pesan Sekarang

                    </a>

                </div>

            </div>

            <div>

                <div class="grid grid-cols-3 gap-6">

                    <div
                        class="bg-white/10 backdrop-blur rounded-2xl text-center py-8">

                        <h3 class="text-4xl font-extrabold">

                            {{ $events->count() }}

                        </h3>

                        <p class="mt-2">

                            Event

                        </p>

                    </div>

                    <div
                        class="bg-white/10 backdrop-blur rounded-2xl text-center py-8">

                        <h3 class="text-4xl font-extrabold">

                            {{ $categories->count() }}

                        </h3>

                        <p class="mt-2">

                            Kategori

                        </p>

                    </div>

                    <div
                        class="bg-white/10 backdrop-blur rounded-2xl text-center py-8">

                        <h3 class="text-4xl font-extrabold">

                            {{ $partners->count() }}

                        </h3>

                        <p class="mt-2">

                            Partner

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FITUR -->

<section class="max-w-7xl mx-auto px-6 pb-20">

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white rounded-3xl p-8 shadow-lg">

            <div class="text-5xl mb-5">

                🎟️

            </div>

            <h3 class="font-bold text-2xl mb-3">

                Booking Online

            </h3>

            <p class="text-slate-500">

                Pesan tiket event kapan saja tanpa harus datang ke lokasi.

            </p>

        </div>

        <div class="bg-white rounded-3xl p-8 shadow-lg">

            <div class="text-5xl mb-5">

                💳

            </div>

            <h3 class="font-bold text-2xl mb-3">

                Pembayaran Aman

            </h3>

            <p class="text-slate-500">

                Seluruh transaksi menggunakan Midtrans Payment Gateway.

            </p>

        </div>

        <div class="bg-white rounded-3xl p-8 shadow-lg">

            <div class="text-5xl mb-5">

                📧

            </div>

            <h3 class="font-bold text-2xl mb-3">

                E-Ticket Otomatis

            </h3>

            <p class="text-slate-500">

                Setelah pembayaran berhasil, E-Ticket akan langsung dikirim melalui email.

            </p>

        </div>

    </div>

</section>

@endsection