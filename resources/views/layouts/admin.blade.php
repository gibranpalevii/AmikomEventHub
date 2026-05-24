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
        <h2 class="text-xl mb-4">Admin</h2>
        <ul>
            <li><a href="/admin/categories">Kategori</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>
</div>

</body>
</html>