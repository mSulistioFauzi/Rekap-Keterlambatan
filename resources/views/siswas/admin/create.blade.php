@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('student.store') }}" method="POST" class="card p-5">
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

        <h2 class="mb-5">Tambah Siswa</h2>

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <input type="number" class="form-control" name="nis" id="nis">
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <input value="" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel</label>
            <select class="form-control" name="rombel_id" id="rombel_id">
                @foreach($rombels as $rombel)
                    <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon</label>
            <select class="form-control" name="rayon_id" id="rayon_id">
                @foreach($rayons as $rayon)
                    <option value="{{ $rayon->id }}">{{ $rayon->rayon }}</option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
</div>
@endsection