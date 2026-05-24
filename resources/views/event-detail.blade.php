@extends('layouts.app')

@section('title', 'Detail Event')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-20">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <img
            src="{{ asset('assets/concert.png') }}"
            class="w-full h-[400px] object-cover"
        >

        <div class="p-8">

            <h1 class="text-4xl font-extrabold mb-4">
                Jazz Night 2024
            </h1>

            <p class="text-slate-500 mb-6">
                Event musik jazz terbesar tahun ini.
            </p>

            <div class="mb-6">

                <p class="font-semibold">
                    📅 16 November 2024
                </p>

                <p class="font-semibold">
                    📍 Jakarta Convention Center
                </p>

            </div>

            <button
                class="bg-indigo-600 text-white px-6 py-3 rounded-2xl"
            >
                Pesan Tiket
            </button>

        </div>

    </div>

</div>

@endsection