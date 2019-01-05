@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Prestasi Sekolah")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-prestasi.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="prestasi-tabel">
      <div class="container prestasi-container">

        <div class="h1-judul">
          <h1 class="text-center"><strong>Prestasi</strong></h1>
          <p class="page-description text-center">MI Muhammadiyah Pucangan</p>

        </div>

          <div class="row justify-content-end">
              <div class="col-6 col-sm-6 col-md-5 col-lg-5 offset-7" id="posisi-col">
                  <form class="search-form">
                      <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text" id="bg-icon-search"><i class="fa fa-search" data-bs-hover-animate="tada" style="font-size:20px;color:rgb(201, 201, 201);"></i></span></div><input class="form-control cari" type="text" placeholder="Cari Prestasi..."
                              id="tabel-border">
                          <div class="input-group-append"></div>
                      </div>
                  </form>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <div class="table-responsive  hasilcari" id="tabel-font">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th class="w-no" >NO</th>
                                  <th class="w-keg">Nama Kegiatan</th>
                                  <th class="w-jen" >Jenis</th>
                                  <th class="w-tkt" >Tingkat</th>
                                  <th class="w-th" >Tahun</th>
                                  <th class="w-pen" >Pencapaian</th>
                              </tr>

                              <tr class="warning no-hasil bg-lighBt">
                                  <td colspan="6" style="background:white;">
                                      <i class="fa fa-warning text-warning"></i>
                                      Tidak ada hasil
                                      
                                  </td>                                    
                              </tr>

                          </thead>
                          <tbody>
                            @foreach ($prestasi as $pres)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $pres->nama }}</td>
                                  <td>{{ $pres->jenis }}</td>
                                  <td>{{ $pres->tingkat }}</td>
                                  <td>{{ $pres->tahun }}</td>
                                  <td>{{ $pres->pencapaian }}</td>
                              </tr>
                            @endforeach
                              
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-lg-3 col-xl-3">
                  <nav aria-label="Paginasi">
                    {!! $prestasi->links(); !!}
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
    <script src="{{ asset('js/bs-animation.js') }}"></script>
    <script src="{{ asset('js/cari-data.js') }}"></script>
@endpush
