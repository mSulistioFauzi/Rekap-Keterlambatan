@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('student.update', $students['id']) }}" method="post" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select class="form-select" name="rombel_id" id="rombel" required>
                    @foreach ($rombels as $rombel)
                        <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <select class="form-select" name="rayon_id" id="rayon" required>
                    @foreach ($rayons as $rayon)
                        <option value="{{ $rayon->id }}">{{ $rayon->rayon }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
</div>
@endsection
