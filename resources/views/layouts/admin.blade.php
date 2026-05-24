<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white p-4 min-h-screen">

        <h2 class="text-2xl font-bold mb-6">
            Admin
        </h2>

        <ul class="space-y-3">

            <li>
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded"
                >
                    Kategori
                </a>
            </li>

            <li>
                <a
                    href="{{ route('admin.partners.index') }}"
                    class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded"
                >
                    Partner
                </a>
            </li>

            <li>
                <a
                    href="{{ route('admin.events.index') }}"
                    class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded"
                >
                    Event
                </a>
            </li>

        </ul>

    </div>

    <!-- Content -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>

</div>

</body>
</html>