<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengurus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header bg-warning">
            <h4>Edit Data Pengurus</h4>
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

            <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">Jabatan</label>

                    <select name="jabatan_id" class="form-select" required>

                        <option value="">-- Pilih Jabatan --</option>

                        @foreach($jabatans as $jabatan)

                            <option value="{{ $jabatan->id }}"
                                {{ $pengurus->jabatan_id == $jabatan->id ? 'selected' : '' }}>

                                {{ $jabatan->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Nama</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $pengurus->name) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"
                        required>{{ old('description', $pengurus->description) }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">Salary</label>

                    <input
                        type="number"
                        name="salary"
                        class="form-control"
                        value="{{ old('salary', $pengurus->salary) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Updated By</label>

                    <input
                        type="text"
                        name="updated_by"
                        class="form-control"
                        value="{{ old('updated_by', $pengurus->updated_by) }}"
                        placeholder="Masukkan nama pengubah data">

                </div>

                <button type="submit" class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('pengurus.index') }}" class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>