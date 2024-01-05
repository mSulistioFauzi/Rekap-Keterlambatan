@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('lates.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf

        @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h2 class="mb-5">Tambah Data Keterlambatan</h2>
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label" @error('student_id')@enderror>siswa</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-control">
                    <option selected disabled hidden>pilih</option>
                    @foreach ($students as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time" class="col-sm-2 col-form-label">Waktu Keterlambatan :</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
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