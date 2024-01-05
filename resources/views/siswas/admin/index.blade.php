@extends('layouts.template')

@section('content')

<div class="container border py-4 rounded">
@if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if(Session::get('deleted'))
    <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
@endif

<h2>Data Siswa</h2>

<div class="d-flex justify-content-end mb-3">
    <a class="btn btn-primary" href="{{ route('student.create') }}">Tambah</a>
</div>
    <table class="table table-striped table-bordered table-hover text-center">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
                <th>Aksi</th>
                
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($students as $student)
            <tr>                    
                <td>{{ $no++ }}</td>
                <td>{{ $student['nis'] }}</td>
                <td>{{ $student['name'] }}</td>
                @foreach ($rombels as  $rombel)
                @if ($rombel->id == $student->rombel_id)
                    <td>
                        {{ $rombel->rombel }}
                    </td>
                    @endif
                @endforeach
                @foreach ($rayons as  $rayon)
                @if ($rayon->id == $student->rayon_id)
                    <td>
                        {{ $rayon->rayon }}
                    </td>
                    @endif
                @endforeach
                {{-- @if (Auth::check())
                    @if (Auth::User()->role == "admin") --}}
                <td class="d-flex justify-content-center">
                    <a href="{{ route('student.edit', $student['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('student.delete', $student['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection