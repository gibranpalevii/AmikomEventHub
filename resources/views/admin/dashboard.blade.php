@extends('layouts.admin')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard Admin
    </h1>

    <p class="text-gray-500 mt-1">
        Selamat datang di sistem manajemen AmikomEventHub
    </p>
</div>

<!-- Statistik -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
        <div class="text-sm opacity-80">
            Total Event
        </div>

        <div class="text-3xl font-bold mt-2">
    {{ $activeEvents }}
</div>

        <div class="mt-2 text-sm">
            Event aktif saat ini
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl shadow-lg">
        <div class="text-sm opacity-80">
            Total User
        </div>

        <div class="text-3xl font-bold mt-2">
            2.000
        </div>

        <div class="mt-2 text-sm">
            Pengguna terdaftar
        </div>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-xl shadow-lg">
        <div class="text-sm opacity-80">
            Total Transaksi
        </div>

        <div class="text-3xl font-bold mt-2">
            120
        </div>

        <div class="mt-2 text-sm">
            Transaksi berhasil
        </div>
    </div>

    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-xl shadow-lg">
        <div class="text-sm opacity-80">
            Pendapatan
        </div>

        <div class="text-3xl font-bold mt-2">
            Rp 12 Jt
        </div>

        <div class="mt-2 text-sm">
            Total pemasukan
        </div>
    </div>

</div>

<!-- Konten Utama -->
<div class="grid lg:grid-cols-3 gap-6">

    <!-- Event Terbaru -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-gray-800">
                Event Terbaru
            </h3>

            <a href="{{ route('admin.events.index') }}"
                class="text-blue-600 text-sm font-semibold">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3">Nama Event</th>
                        <th class="text-left py-3">Tanggal</th>
                        <th class="text-left py-3">Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-b">
                        <td class="py-3">AI & Future Tech Summit</td>
                        <td>01 Mei 2026</td>
                        <td>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3">Hackathon Developer Fest</td>
                        <td>05 Mei 2026</td>
                        <td>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3">Jazz Night 2026</td>
                        <td>10 Mei 2026</td>
                        <td>
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Upcoming
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Aktivitas -->
    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-lg font-bold text-gray-800 mb-5">
            Aktivitas Terbaru
        </h3>

        <div class="space-y-4">

            <div class="border-l-4 border-blue-500 pl-4">
                <p class="font-semibold">
                    Event Baru Ditambahkan
                </p>
                <p class="text-sm text-gray-500">
                    AI & Future Tech Summit
                </p>
            </div>

            <div class="border-l-4 border-green-500 pl-4">
                <p class="font-semibold">
                    Transaksi Baru
                </p>
                <p class="text-sm text-gray-500">
                    Pembelian tiket berhasil
                </p>
            </div>

            <div class="border-l-4 border-purple-500 pl-4">
                <p class="font-semibold">
                    User Baru
                </p>
                <p class="text-sm text-gray-500">
                    Registrasi pengguna baru
                </p>
            </div>

            <div class="border-l-4 border-orange-500 pl-4">
                <p class="font-semibold">
                    Partner Ditambahkan
                </p>
                <p class="text-sm text-gray-500">
                    PT Teknologi Nusantara
                </p>
            </div>

        </div>

    </div>

</div>

<!-- Ringkasan -->
<div class="grid md:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-lg font-bold mb-4">
            Ringkasan Sistem
        </h3>

        <ul class="space-y-3">

            <li class="flex justify-between">
                <span>Total Event</span>
                <span class="font-bold">50</span>
            </li>

            <li class="flex justify-between">
                <span>Total Kategori</span>
                <span class="font-bold">10</span>
            </li>

            <li class="flex justify-between">
                <span>Total Partner</span>
                <span class="font-bold">15</span>
            </li>

            <li class="flex justify-between">
                <span>Total Tiket Terjual</span>
                <span class="font-bold">3.500</span>
            </li>

        </ul>

    </div>

   <div class="bg-white rounded-xl shadow p-6 mt-8">

    <h3 class="text-xl font-bold mb-5">
    </h3>

    <canvas id="eventChart" height="100"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('eventChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($eventLabels),
        datasets: [{
            label: 'Tiket Terjual',
            data: @json($ticketData),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</div>

<!-- Grafik -->
<div class="bg-white rounded-xl shadow p-6 mt-8">

    <h3 class="text-xl font-bold mb-5">
        Grafik Tiket Terjual per Event
    </h3>

    <canvas id="eventChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('eventChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($eventLabels),
        datasets: [{
            label: 'Tiket Terjual',
            data: @json($ticketData),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

@endsection