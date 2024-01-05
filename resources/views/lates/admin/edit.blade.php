@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('lates.update', $lates['id']) }}" method="post" class="card p-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @if ($errors->any())
        <ul class="alert alert-danger p-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <h2 class="mb-5">Edit Data Keterlambatan</h2>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama Siswa :</label>
            <div class="col-sm-10">
                <select class="form-select" name="name" id="name" required>
                    <option value="" disabled selected>Select Nama Siswa</option>
                        @foreach($students as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Waktu Keterlambatan :</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Informasi Keterlambatan :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti Keterlambatan :</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
</div>
@endsection