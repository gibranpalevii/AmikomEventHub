<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title','AmikomEventHub')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family:'Plus Jakarta Sans',sans-serif;
        }

        .glass{
            background:rgba(255,255,255,.8);
            backdrop-filter:blur(14px);
        }

    </style>

</head>

<body class="bg-slate-50 text-slate-900">

<nav class="glass sticky top-0 z-50 shadow">

<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

<a href="{{ route('home') }}"
class="flex items-center gap-3">

<div class="w-11 h-11 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
AH
</div>

<div>

<p class="font-bold text-xl">
AmikomEventHub
</p>

<p class="text-xs text-slate-500">
Platform Reservasi Event
</p>

</div>

</a>

<div class="hidden md:flex items-center gap-8">

<a href="{{ route('home') }}"
class="hover:text-indigo-600 font-medium">

Home

</a>

<a href="#events"
class="hover:text-indigo-600 font-medium">

Event

</a>

<a href="#"
class="hover:text-indigo-600 font-medium">

Partner

</a>

<a href="#"
class="hover:text-indigo-600 font-medium">

Kategori

</a>

</div>

<div class="flex items-center gap-3">

@guest

<a href="{{ route('google.login') }}"
class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl font-semibold">

Login Google

</a>

<a href="{{ route('admin.login') }}"
class="border px-5 py-2 rounded-xl hover:bg-slate-100 font-semibold">

Admin Login

</a>

@endguest


@auth

<div class="text-right">

<p class="font-bold">

{{ auth()->user()->name }}

</p>

<p class="text-xs text-slate-500">

{{ auth()->user()->email }}

</p>

</div>

@if(auth()->user()->role=="admin")

<a href="{{ route('admin.dashboard') }}"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl">

Dashboard

</a>

@endif

<form method="POST"
action="{{ route('admin.logout') }}">

@csrf

<button
class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl">

Logout

</button>

</form>

@endauth

</div>

</div>

</nav>


@if(session('success'))

<div class="max-w-7xl mx-auto mt-5">

<div class="bg-green-100 text-green-700 px-5 py-4 rounded-xl">

{{ session('success') }}

</div>

</div>

@endif


@if(session('error'))

<div class="max-w-7xl mx-auto mt-5">

<div class="bg-red-100 text-red-700 px-5 py-4 rounded-xl">

{{ session('error') }}

</div>

</div>

@endif


@yield('content')


<footer class="bg-indigo-900 text-white mt-20">

<div class="max-w-7xl mx-auto py-14 px-6 grid md:grid-cols-3 gap-10">

<div>

<h2 class="text-2xl font-bold mb-3">

AmikomEventHub

</h2>

<p class="text-indigo-200">

Platform pemesanan tiket event berbasis Laravel.

</p>

</div>

<div>

<h3 class="font-bold mb-3">

Menu

</h3>

<ul class="space-y-2">

<li><a href="{{ route('home') }}">Home</a></li>

<li><a href="#events">Event</a></li>

<li>Partner</li>

<li>Kategori</li>

</ul>

</div>

<div>

<h3 class="font-bold mb-3">

Developer

</h3>

<p>

Universitas Amikom Yogyakarta

</p>

<p>

Laravel 13 + Tailwind CSS

</p>

</div>

</div>

<div class="border-t border-indigo-700 py-5 text-center text-indigo-200">

© {{ date('Y') }} AmikomEventHub

</div>

</footer>

</body>

</html>