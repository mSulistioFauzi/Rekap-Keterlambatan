@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('rayon.store') }}" method="POST" class="card p-5">
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

        <h2 class="mb-5">Tambah Rayon</h2>

        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Pembimbing Siswa :</label>
            <div class="col-sm-10">
                <select class="form-select" name="user_id" id="user_id" required>
                    <option selected disabled>Pilih PS</option>
                    @foreach ($users as $user)
                        @if ($user->role == 'ps')
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
</div>
@endsection