@extends('layouts.app')

@section('title', 'Katalog Event')

@section('content')
<div class="mb-10 text-center">
    <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Eksplorasi Event</h1>
    <p class="text-slate-500">Temukan berbagai kegiatan menarik di AmikomEventHub</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @for ($i = 1; $i <= 6; $i++)
    <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-300">
        <div class="relative">
            <div class="h-48 bg-slate-100 flex items-center justify-center overflow-hidden">
                 <i class="fa-regular fa-image text-4xl text-slate-300"></i>
            </div>
            <div class="absolute top-4 left-4 bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                Terbaru
            </div>
        </div>
        <div class="p-6">
            <h3 class="font-bold text-xl mb-2 group-hover:text-indigo-600 transition">Seminar Teknologi #{{ $i }}</h3>
            <p class="text-slate-600 text-sm mb-4 line-clamp-2">Deskripsi singkat event yang akan dilaksanakan di gedung Amikom untuk mahasiswa umum.</p>
            <div class="flex items-center justify-between mt-6 pt-6 border-t border-slate-100 text-sm">
                <span class="text-indigo-600 font-semibold"><i class="fa-regular fa-calendar mr-2"></i>12 Okt 2024</span>
                <a href="#" class="text-slate-400 hover:text-indigo-600"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    @endfor
</div>
@endsection