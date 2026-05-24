@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Manajemen Partner
    </h1>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="bg-white p-4 rounded shadow mb-4">

        <form action="{{ route('admin.partners.index') }}" method="GET">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari partner..."
                    value="{{ request('search') }}"
                    class="border p-2 rounded w-full"
                >

                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Search
                </button>

            </div>

        </form>

    </div>

    {{-- Form Tambah Partner --}}
    <div class="bg-white p-4 rounded shadow mb-6">

        <form
            action="{{ route('admin.partners.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="grid grid-cols-1 gap-4">

                <input
                    type="text"
                    name="name"
                    placeholder="Nama Partner"
                    class="border p-2 rounded"
                    required
                >

                <input
                    type="file"
                    name="logo_url"
                    class="border p-2 rounded"
                >

                <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                >
                    Tambah Partner
                </button>

            </div>

        </form>

    </div>

    {{-- Table Partner --}}
    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Logo</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Created At</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($partners as $partner)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $partner->id }}
                    </td>

                    <td class="p-3">

                        @if($partner->logo_url)

                            <img
                                src="{{ asset('uploads/partners/' . $partner->logo_url) }}"
                                width="80"
                                class="rounded"
                            >

                        @else

                            <span class="text-gray-400">
                                Tidak ada logo
                            </span>

                        @endif

                    </td>

                    <td class="p-3">
                        {{ $partner->name }}
                    </td>

                    <td class="p-3">
                        {{ $partner->created_at }}
                    </td>

                    <td class="p-3">

                        {{-- FORM EDIT --}}
                        <form
                            action="{{ route('admin.partners.update', $partner->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="flex flex-col gap-2 mb-3"
                        >

                            @csrf
                            @method('PUT')

                            <input
                                type="text"
                                name="name"
                                value="{{ $partner->name }}"
                                class="border p-2 rounded"
                                required
                            >

                            <input
                                type="file"
                                name="logo_url"
                                class="border p-2 rounded"
                            >

                            <button
                                type="submit"
                                class="bg-yellow-400 hover:bg-yellow-500 px-3 py-2 rounded"
                            >
                                Edit
                            </button>

                        </form>

                        {{-- FORM DELETE --}}
                        <form
                            action="{{ route('admin.partners.destroy', $partner->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus partner ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded w-full"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="p-4 text-center text-gray-500">
                        Data partner belum tersedia
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection