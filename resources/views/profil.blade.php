@extends('layouts.app')

@section('title', 'Profil Praktikan')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
    <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
    <div class="px-8 pb-8 -mt-16 text-center">
        <div class="inline-block p-1 bg-white rounded-full mb-4">
            <div class="w-24 h-24 bg-slate-200 rounded-full flex items-center justify-center text-3xl font-bold text-indigo-600 border-4 border-white">
                GB
            </div>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Gibran Shafi Nugraha</h1>
        <p class="text-slate-500 mb-6 italic">24.12.3359 - Sistem Informasi</p>
        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
            <div class="p-3 bg-slate-50 rounded-xl">
                <span class="block font-bold text-indigo-600">Kelas</span>
                <span class="text-slate-600">SI - 05</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl">
                <span class="block font-bold text-indigo-600">Status</span>
                <span class="text-slate-600">Aktif</span>
            </div>
        </div>
        <button class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
            Edit Profil
        </button>
    </div>
</div>
@endsection