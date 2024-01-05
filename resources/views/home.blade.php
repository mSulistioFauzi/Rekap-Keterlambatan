@extends('layouts.template')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
          <main class="content px-3 py-2">
               @if (Session::get('cantAccess'))
               <div class="alert alert-danger">{{ Session::get('cantAccess') }}</div>
               @endif

               <div class="container-fluid">
               <div class="mb-3">
                    <h2>Dashboard</h2>
               </div>

               @if (Auth::user()->role == 'admin')
               
               <div class="card border-0">
                    <div class="container px-4">
                         <div class="row g-3 my-2 mb-4">
                              <div class="col-md-3">
                                   <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                   <div>
                                        <h3 class="fs-2">{{ $student }}</h3>
                                        <p class="fs-5">Peserta Didik</p>
                                   </div>
                                   <i class="ri-user-fill fs-1"></i>
                                   </div>
                              </div>

                              <div class="col-md-3">
                                   <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                   <div>
                                        <h3 class="fs-2">{{ $admin }}</h3>
                                        <p class="fs-5">Administrator</p>
                                   </div>
                                   <i class="ri-user-fill fs-1"></i>
                                   </div>
                              </div>

                              <div class="col-md-3">
                                   <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                   <div>
                                        <h3 class="fs-2">{{ $ps }}</h3>
                                        <p class="fs-5">Pembimbing Siswa</p>
                                   </div>
                                   <i class="ri-user-fill fs-1"></i>
                                   </div>
                              </div>

                              <div class="col-md-3">
                                   <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                   <div>
                                        <h3 class="fs-2">{{ $rombel }}</h3>
                                        <p class="fs-5">Rombel</a></p>
                                   </div>
                                   <i class="ri-bookmark-fill fs-1"></i>
                                   </div>
                              </div>

                              <div class="col-md-3">
                                   <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                   <div>
                                        <h3 class="fs-2">{{ $rayon }}</h3>
                                        <p class="fs-5">Rayon</p>
                                   </div>
                                   <i class="ri-bookmark-fill fs-1"></i>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               
               @endif

               @if (Auth::user()->role == 'ps')
                    <div class="card border-0">
                         <div class="container px-4">
                              <div class="row g-3 my-2 mb-4">
                                   <div class="col-md-3">
                                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                        <div>
                                             <h3 class="fs-2">{{ $todayLateCount }}</h3>
                                             <p class="fs-5">Tanggal: {{ now()->format('Y-m-d') }}</p>
                                        </div>
                                        <i class="ri-user-fill fs-1"></i>
                                   </div>
                                   <a href="#" class="btn btn-primary mt-2">
                                        <i class="bi bi-person"></i> View Details
                                      </a>
                                   </div>

                                   <div class="col-md-3">
                                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                        <div>
                                             <h3 class="fs-2">{{ $lates1 }}</h3>
                                             <p class="fs-5">Peserta Didik {{Auth::user()->name}}</p>
                                        </div>
                                        <i class="ri-user-fill fs-1"></i>
                                   </div>
                                   <a href="#" class="btn btn-primary mt-2">
                                        <i class="bi bi-person"></i> View Details
                                      </a>
                                   </div>

                                   
                              </div>
                         </div>
                    </div>
                    @endif
               </div>
          </main>

      <script src="{{ asset('js/script.js') }}"></script>

@endsection