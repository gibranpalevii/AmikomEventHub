@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        Manajemen Kategori
    </h1>

    {{-- Alert Success --}}
    @if(session('success'))

        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>

    @endif

    {{-- Search --}}
    <div class="bg-white p-4 rounded shadow mb-4">

        <form
            action="{{ route('admin.categories.index') }}"
            method="GET"
        >

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari kategori..."
                    value="{{ request('search') }}"
                    class="border p-3 rounded w-full"
                >

                <button
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded"
                >
                    Search
                </button>

            </div>

        </form>

    </div>

    {{-- Form Tambah --}}
    <div class="bg-white p-4 rounded shadow mb-6">

        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
        >

            @csrf

            <div class="flex gap-3">

                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama kategori"
                    class="border p-3 rounded w-full"
                    required
                >

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded"
                >
                    Tambah
                </button>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>

                    <th class="p-4">ID</th>
                    <th class="p-4">Nama Kategori</th>
                    <th class="p-4">Created At</th>
                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr class="border-b">

                        <td class="p-4">
                            {{ $category->id }}
                        </td>

                        <td class="p-4">
                            {{ $category->name }}
                        </td>

                        <td class="p-4">
                            {{ $category->created_at }}
                        </td>

                        <td class="p-4">

                            {{-- Form Edit --}}
                            <form
                                action="{{ route('admin.categories.update', $category->id) }}"
                                method="POST"
                                class="flex gap-2 mb-2"
                            >

                                @csrf
                                @method('PUT')

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ $category->name }}"
                                    class="border p-2 rounded w-full"
                                    required
                                >

                                <button
                                    type="submit"
                                    class="bg-yellow-400 hover:bg-yellow-500 px-4 py-2 rounded"
                                >
                                    Edit
                                </button>

                            </form>

                            {{-- Delete --}}
                            <form
                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="p-4 text-center text-gray-500">
                            Data kategori belum tersedia
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection