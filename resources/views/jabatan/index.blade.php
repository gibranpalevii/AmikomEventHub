<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jabatan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Jabatan</h2>

        <a href="{{ route('jabatan.create') }}" class="btn btn-primary">
            + Tambah Jabatan
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
            <th width="70">No</th>
            <th>Nama Jabatan</th>
            <th>Created By</th>
            <th width="180">Aksi</th>
        </tr>

        </thead>

        <tbody>

        @forelse($jabatans as $jabatan)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $jabatan->name }}</td>

            <td>{{ $jabatan->created_by }}</td>

            <td>

                <a href="{{ route('jabatan.edit',$jabatan->id) }}"
                   class="btn btn-warning btn-sm">

                    Edit

                </a>

                <form action="{{ route('jabatan.destroy',$jabatan->id) }}"
                      method="POST"
                      style="display:inline-block;">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="4" class="text-center">
                Belum ada data jabatan.
            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>