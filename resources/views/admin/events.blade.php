@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Manajemen Event</h2>

<table class="w-full bg-white rounded-xl shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama Event</th>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-3">Workshop UI/UX</td>
            <td class="p-3">10 Mei</td>
            <td class="p-3">Edit | Hapus</td>
        </tr>
    </tbody>
</table>
@endsection