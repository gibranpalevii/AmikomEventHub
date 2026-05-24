@extends('layouts.app')

@section('title', 'Pusat Bantuan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-slate-800 mb-4">Ada yang bisa kami bantu?</h1>
        <div class="relative">
            <input type="text" placeholder="Cari pertanyaan..." class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
        </div>
    </div>

    <div class="space-y-4">
        @php
            $faqs = [
                ['q' => 'Bagaimana cara membatalkan pendaftaran event?', 'a' => 'Buka menu profil, pilih riwayat event, lalu klik tombol batalkan pada event yang diinginkan.'],
                ['q' => 'Apakah sertifikat akan dikirim otomatis?', 'a' => 'Ya, sertifikat akan dikirim ke email terdaftar maksimal 3 hari setelah event berakhir.'],
                ['q' => 'Saya lupa password akun, apa yang harus dilakukan?', 'a' => 'Gunakan fitur "Lupa Password" pada halaman login untuk mereset kata sandi Anda.'],
            ];
        @endphp

        @foreach ($faqs as $faq)
        <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:border-indigo-300 transition group cursor-pointer shadow-sm">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-slate-700 group-hover:text-indigo-600">{{ $faq['q'] }}</h3>
                <i class="fa-solid fa-chevron-down text-slate-400 text-sm"></i>
            </div>
            <p class="text-slate-500 mt-4 text-sm leading-relaxed">{{ $faq['a'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection