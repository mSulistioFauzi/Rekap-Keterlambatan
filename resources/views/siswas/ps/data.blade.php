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

    <table class="table table-striped table-bordered table-hover text-center">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
                
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($siswa as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->name }}</td> 
                <td>{{ $item->rombels->rombel}}</td> 
                <td>{{ $item->rayons->rayon}}</td> 
             </tr>
    @endforeach
        </tbody>
    </table>
</div>
@endsection