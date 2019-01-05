@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Materi Pembelajaran")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-tabel-materi.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="tabel-data">
          <div class="container tabel-container">
            
            <div class="h1-judul">
              <h1 class="text-center"><strong>Unduh Materi</strong></h1>
              <p class="page-description text-center">MIM Pucangan</p>

            </div>

            

              <div class="row justify-content-end">
                  <div class="col-6 col-sm-6 col-md-5 col-lg-5 offset-7" id="posisi-col">
                      <form class="search-form">
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="bg-icon-search"><i class="fa fa-search" data-bs-hover-animate="tada" style="font-size:20px;color:rgb(255,184,0);"></i></span></div><input class="form-control cari" type="text" placeholder="Cari...."
                                  id="tabel-border">
                              <div class="input-group-append"></div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                        <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th style="width:155px;">Tanggal</th>
                                      <th style="width:350px;">Judul</th>
                                      <th style="width:343px;">Mata Pelajaran</th>
                                      <th style="width:119px;">Kelas</th>
                                      <th id="unduh-center" style="width:127px;">Unduh</th>
                                  </tr>
                                  <tr class="warning no-hasil bg-light">
                                      <td colspan="5">
                                          <i class="fa fa-warning text-warning"></i>
                                          Tidak ada hasil
                                          
                                      </td>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($materi as $mat)
                                  <tr>
                                      <td style="width: 140px">
                                        {{ 
                                          $mat->created_at->formatLocalized('%A, %d/%m/%Y') 
                                        }}
                                      </td>
                                      <td>{{ $mat->nama }}</td>
                                      
                                      <td>
                                        @if ($mat->mapel->nama)
                                          {{ $mat->mapel->nama }}
                                        @endif
                                      </td>
                                      <td>
                                        @if ($mat->kelas->nama)
                                          {{ $mat->kelas->nama }}
                                        @endif
                                      </td>
                                      <td class="text-center">
                                          <div><a href="{{ asset('storage/materi/' . $mat->path) }}"><i class="fas fa-download icon-unduh"></i></a></div>
                                      </td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center mt-5">
                  <div class="col-lg-3 col-xl-3">
                      <nav aria-label="Paginasi">
                        {!! $materi->links(); !!}
                      </nav>
                  </div>
              </div>
          </div>
  </section>

  {{-- Footer --}}
  @include('partials._footer_web')
@endsection

@push('scripts')
    <!-- core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
@endpush
