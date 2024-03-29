@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <div id="msg-success"></div>

@if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
@endif
@if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
@endif

<h2>Data Keterlambatan</h2>

    <div class="d-flex justify-content mb-3">
        <a class="btn btn-primary" href="{{ route('lates.create') }}">Tambah</a>
        <a class="btn btn-secondary" href="{{ route('lates.export-excel') }}">Export Data Keterlambatan</a>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab"  
                aria-controls="simple-tabpanel-0" aria-selected="true">Keseluruhan Data</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                aria-controls="simple-tabpanel-1" aria-selected="false">Rekapitulasi Data</a>
        </li>
    </ul>

    <div class="tab-content pt-5" id="tab-content">
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal & Waktu</th>
                        <th>Informasi</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($lates as $late)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $late->students->name }}</td>
                            <td>{{ $late->date_time }}</td>
                            <td>{{ $late->information }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('lates.edit', $late['id']) }}" class="btn btn-primary me-3">Edit</a>
                                <form action="{{ route('lates.delete', $late['id']) }}" method="post">
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

        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
        
                    @foreach ($groupedLates as $nis => $group)
                        @php
                            $total = $group->where('students.nis')->count();
                        @endphp
        
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $nis }}</td>
                            <td>{{ $group->first()->students->name }}</td>
                            <td>{{ $total }}</td>
                            <td>
                                <a href="{{ route('lates.detail', $group->first()['student_id']) }}" class="btn btn-primary me-2">Lihat</a>
                            </td>
                            @if ($total >= 3)
                            <td>
                                <a href="{{ route('lates.download', $group->first()['id']) }}" class="btn btn-secondary">Unduh Surat Pernyataan</a>
                            </td>
                                @else
                                    <td>Harus Lebih dari 3</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                
            </div>
        </div>
@endsection