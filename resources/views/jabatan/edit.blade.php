<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jabatan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header bg-warning">
            <h4>Edit Data Jabatan</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Jabatan
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $jabatan->name) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Updated By
                    </label>

                    <input
                        type="text"
                        name="updated_by"
                        class="form-control"
                        value="{{ old('updated_by', $jabatan->updated_by) }}"
                        placeholder="Masukkan nama yang mengubah data">

                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>