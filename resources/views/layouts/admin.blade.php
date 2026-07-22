<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Inter, sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-900 text-white flex flex-col">

        <div class="px-6 py-8 border-b border-indigo-800">
            <h1 class="text-xl font-black">
                AmikomEventHub
            </h1>

            <p class="text-indigo-300 text-xs mt-1">
                Admin Panel
            </p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-xl hover:bg-indigo-800 transition">
                Dashboard
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-indigo-800 transition">
                Kelola Event
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-indigo-800 transition">
                Kelola Kategori
            </a>

            <a href="{{ route('admin.partners.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-indigo-800 transition">
                Kelola Partner
            </a>

            <a href="{{ route('admin.transactions.index') }}"
               class="block px-4 py-3 rounded-xl hover:bg-indigo-800 transition">
                Laporan Transaksi
            </a>

        </nav>

        <div class="p-4 border-t border-indigo-800">

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 px-4 py-3 rounded-xl font-semibold transition">
                    Keluar
                </button>
            </form>

        </div>

    </aside>

    <!-- Main Content -->
    <main class="flex-1">

        <!-- Header -->
        <header class="bg-white border-b border-slate-200 px-10 py-6 flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-black text-slate-800">
                    @yield('page_title', 'Dashboard')
                </h1>

                <p class="text-slate-500 mt-1">
                    @yield('page_subtitle', 'Selamat datang di panel admin.')
                </p>
            </div>

            <div class="flex items-center gap-3">

                <div class="text-right">
                    <p class="font-bold text-slate-800">
                        Admin
                    </p>

                    <p class="text-xs text-slate-400">
                        Penyelenggara Event
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">
                    A
                </div>

            </div>

        </header>

        <!-- Content -->
        <div class="p-10">

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700 border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>