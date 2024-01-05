@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <form action="{{ route('rayon.update', $rayons['id']) }}" method="post" class="card p-5">
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
            <label for="name" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayons['rayon'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Pembimbing Siswa :</label>
            <div class="col-sm-10">
                <select class="form-control" name="user_id" id="user_id" required>
                    <option value="{{ $rayons['user_id'] }}"></option>
                    @foreach ($users as $user)
                        @if ($user->role == 'ps')
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
</div>
@endsection
