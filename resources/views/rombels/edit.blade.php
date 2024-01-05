@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('rombel.update', $rombel['id']) }}" method="post" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select class="form-select" name="rombel" id="rombel" required>
                    <option selected disabled hidden >Pilih</option>
                    <option value="PPLG XI-1">PPLG XI-1</option>
                    <option value="PPLG XI-2">PPLG XI-2</option>
                    <option value="PPLG XI-3">PPLG XI-3</option>
                    <option value="PPLG XI-4">PPLG XI-4</option>
                    <option value="PPLG XI-5">PPLG XI-5</option>
                    <option value="PPLG XI-6">PPLG XI-6</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
</div>
@endsection
