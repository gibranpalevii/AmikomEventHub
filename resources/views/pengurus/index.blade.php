<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengurus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Data Pengurus</h2>

        <a href="{{ route('pengurus.create') }}" class="btn btn-primary">
            + Tambah Pengurus
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <th width="180">Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse($pengurus as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->name }}</td>

                <td>{{ $item->jabatan->name }}</td>

                <td>Rp {{ number_format($item->salary,0,',','.') }}</td>

                <td>

                    <a href="{{ route('pengurus.edit',$item->id) }}"
                        class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('pengurus.destroy',$item->id) }}"
                          method="POST"
                          style="display:inline-block;">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="text-center">

                    Belum ada data pengurus.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</body>
</html>