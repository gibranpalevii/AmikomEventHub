@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')

<main class="max-w-3xl mx-auto px-6 py-20">

    <div class="mb-12">
        <a href="{{ route('events.show', $event->id) }}"
            class="text-indigo-600 font-bold flex items-center gap-2 mb-6">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7">
                </path>
            </svg>

            Kembali ke Event
        </a>

        <h1 class="text-4xl font-extrabold">
            Checkout
        </h1>

        <p class="text-slate-500 mt-2">
            Lengkapi data Anda untuk mendapatkan tiket.
        </p>

    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl font-bold">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-8">

        <!-- Ringkasan -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-xl font-bold mb-6 border-b pb-4">
                Pesanan Anda
            </h3>

            <div class="flex gap-6 items-start">

                <img
                    src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                        ? asset('storage/'.$event->poster_path)
                        : 'https://placehold.co/200x200' }}"
                    class="w-24 h-24 rounded-2xl object-cover">

                <div>

                    <h4 class="font-extrabold text-lg">
                        {{ $event->title }}
                    </h4>

                    <p class="text-slate-500">
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                        •
                        {{ $event->location }}
                    </p>

                    @if($event->price == 0)

                        <p class="text-green-600 font-bold mt-2">
                            GRATIS
                        </p>

                    @else

                        <p class="text-indigo-600 font-bold mt-2">
                            1 x Rp {{ number_format($event->price,0,',','.') }}
                        </p>

                    @endif

                </div>

            </div>

            <div class="mt-8 pt-6 border-t space-y-3">

                <div class="flex justify-between text-slate-500">
                    <span>Harga Tiket</span>

                    @if($event->price == 0)
                        <span class="text-green-600 font-bold">
                            GRATIS
                        </span>
                    @else
                        <span>
                            Rp {{ number_format($event->price,0,',','.') }}
                        </span>
                    @endif
                </div>

                @if($event->price > 0)

                <div class="flex justify-between text-slate-500">
                    <span>Biaya Layanan</span>
                    <span>Rp 5.000</span>
                </div>

                @endif

                <div class="flex justify-between text-2xl font-black mt-4 pt-4 border-t">

                    <span>Total Bayar</span>

                    @if($event->price == 0)

                        <span class="text-green-600">
                            GRATIS
                        </span>

                    @else

                        <span class="text-indigo-600">
                            Rp {{ number_format($event->price + 5000,0,',','.') }}
                        </span>

                    @endif

                </div>

            </div>

        </div>

        <!-- Form -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-xl font-bold mb-6 italic text-indigo-600 underline underline-offset-8">
                📦 Data Pemesan
            </h3>

            <form action="{{ route('checkout.store',$event->id) }}"
                method="POST"
                class="space-y-6">

                @csrf

                <div>

                    <label class="block text-sm font-bold mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        required
                        class="w-full px-5 py-4 border rounded-2xl">

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-bold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="customer_email"
                            value="{{ old('customer_email') }}"
                            required
                            class="w-full px-5 py-4 border rounded-2xl">

                    </div>

                    <div>

                        <label class="block text-sm font-bold mb-2">
                            No WhatsApp
                        </label>

                        <input
                            type="text"
                            name="customer_phone"
                            value="{{ old('customer_phone') }}"
                            required
                            class="w-full px-5 py-4 border rounded-2xl">

                    </div>

                </div>

                @if($event->price == 0)

                    <button
                        type="submit"
                        class="w-full py-5 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-xl">

                        🎟️ Dapatkan E-Ticket Gratis

                    </button>

                @else

                    <button
                        type="submit"
                        class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black text-xl">

                        Lanjut Pembayaran

                    </button>

                @endif

            </form>

        </div>

    </div>

</main>

@endsection