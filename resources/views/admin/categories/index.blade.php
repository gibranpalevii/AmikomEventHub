@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Manajemen Kategori</h1>

    <div class="mb-4">
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
            + Tambah Kategori
        </button>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $categories = ['Seminar', 'Konser', 'Workshop'];
                @endphp

                @foreach($categories as $i => $cat)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $i + 1 }}</td>
                    <td class="p-3">{{ $cat }}</td>
                    <td class="p-3 text-center space-x-2">

                        <button class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded">
                            Edit
                        </button>

                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Hapus
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection