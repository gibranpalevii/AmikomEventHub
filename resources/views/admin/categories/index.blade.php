@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Manajemen Kategori</h1>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Kategori --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="flex gap-3">
                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama kategori"
                    class="border p-2 rounded w-full"
                    required
                >

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Tambah
                </button>
            </div>
        </form>
    </div>

    {{-- Table Categories --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3">Created At</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $category->id }}
                    </td>

                    <td class="p-3">
                        {{ $category->name }}
                    </td>

                    <td class="p-3">
                        {{ $category->created_at }}
                    </td>

                    <td class="p-3 text-center">

                        {{-- Form Edit --}}
                        <form
                            action="{{ route('admin.categories.update', $category->id) }}"
                            method="POST"
                            class="inline-block"
                        >
                            @csrf
                            @method('PUT')

                            <input
                                type="text"
                                name="name"
                                value="{{ $category->name }}"
                                class="border p-1 rounded"
                                required
                            >

                            <button
                                type="submit"
                                class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded"
                            >
                                Edit
                            </button>
                        </form>

                        {{-- Form Delete --}}
                        <form
                            action="{{ route('admin.categories.destroy', $category->id) }}"
                            method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
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