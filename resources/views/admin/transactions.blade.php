@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Transaksi</h2>

<table class="w-full bg-white rounded-xl shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Event</th>
            <th class="p-3">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-3">Gibran</td>
            <td class="p-3">Seminar AI</td>
            <td class="p-3 text-green-600">Lunas</td>
        </tr>
    </tbody>
</table>
@endsection