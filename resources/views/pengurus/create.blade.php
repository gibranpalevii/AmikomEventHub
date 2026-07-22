<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengurus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h4>Tambah Pengurus</h4>

</div>

<div class="card-body">

@if ($errors->any())

<div class="alert alert-danger">

<ul>

@foreach ($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('pengurus.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Jabatan</label>

<select name="jabatan_id" class="form-select" required>

<option value="">-- Pilih Jabatan --</option>

@foreach($jabatans as $jabatan)

<option value="{{ $jabatan->id }}">

{{ $jabatan->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="3"
required>{{ old('description') }}</textarea>

</div>

<div class="mb-3">

<label>Salary</label>

<input
type="number"
name="salary"
class="form-control"
value="{{ old('salary') }}"
required>

</div>

<div class="mb-3">

<label>Created By</label>

<input
type="text"
name="created_by"
class="form-control"
value="{{ old('created_by') }}"
required>

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="{{ route('pengurus.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>