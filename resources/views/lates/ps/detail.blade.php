@extends('layouts.template')

@section('content')
    <div class="container border py-4 rounded">
        <div id="msg-success"></div>

        <h2>Data Keterlambatan - {{ $student->name }}</h2>

        <!-- Other content you want to display -->

        <div class="row mt-3">
            @foreach ($lates as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Keterlambatan {{ $loop->iteration }}</h4>
                            <p class="card-text">Tanggal: {{ \Carbon\Carbon::parse($item->date_time)->format('d F Y H:i:s') }}</p>
                            <p class="card-text text-primary">Informasi: {{ $item->information }}</p>
                            <center>
                                <img src="{{ asset('images/' . $item->bukti) }}" alt="" width="100px"
                                    style="aspect-ratio: 100/90; object-fit: contain;">
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
