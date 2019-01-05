@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Guru MIM Pucangan")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-tabel-guru.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="tabel-data">
          <div class="container tabel-container">
            
            <div class="h1-judul">
              <h1 class="text-center"><strong>Data Guru</strong></h1>
              <p class="page-description text-center">MIM Pucangan</p>

            </div>

            

              <div class="row justify-content-end">
                  <div class="col-6 col-sm-6 col-md-5 col-lg-5 offset-7" id="posisi-col">
                      <form class="search-form">
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="bg-icon-search"><i class="fa fa-search" data-bs-hover-animate="tada" style="font-size:20px;color:rgb(0,117,255);"></i></span></div><input class="form-control cari" type="text" placeholder="Cari Data Guru..."
                                  id="tabel-border">
                              <div class="input-group-append"></div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="row">
                <div class="col">
                    <div class="table-responsive hasilcari" id="tabel-font">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width:50px;">NO</th>
                                    <th id="foto" style="width:60px;">FOTO</th>
                                    <th style="width:205px;">NIP</th>
                                    <th style="width:258px;">NAMA</th>
                                    <th style="width:250px;">JENIS KELAMIN</th>
                                    <th style="width:210px;">JABATAN</th>
                                </tr>
                                <tr class="warning no-hasil bg-light">
                                      <td colspan="5">
                                          <i class="fa fa-warning text-warning"></i>
                                          Tidak ada hasil
                                          
                                      </td>
                                      
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($guru as $gr)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                      @if ($gr->foto)
                                        <div class="body-img" 
                                        style="width:45px;">
                                          <img src="{{ asset('storage/foto/siswa/' . $gr->foto) }}">
                                        </div>
                                      @else
                                        <div class="body-img" 
                                        style="width:45px;">
                                          <img src="/img/i-people1.png">
                                        </div>
                                      @endif
                                        
                                    </td>
                                    <td>
                                      {{ $gr->nip }}
                                    </td>
                                    <td>{{ $gr->nama }}</td>
                                    <td>{{ (strtoupper($gr->jenis_kelamin) == 'L') ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $gr->jabatan }}</td>
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
                    {!! $guru->links(); !!}
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
