@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Alumni MIM Pucangan")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-tabel-alumni.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="tabel-data">
          <div class="container tabel-container">
            
            <div class="h1-judul">
              <h1 class="text-center"><strong>Data Alumni</strong></h1>
              <p class="page-description text-center">MIM Pucangan</p>

            </div>

            

              <div class="row justify-content-end">
                  <div class="col-6 col-sm-6 col-md-5 col-lg-5 offset-7" id="posisi-col">
                      <form class="search-form">
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text" id="bg-icon-search"><i class="fa fa-search" data-bs-hover-animate="tada" style="font-size:20px;color:rgb(0,173,38);"></i></span></div><input class="form-control cari" type="text" placeholder="Cari Data Alumni..."
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
                                    <th id="foto" style="width:81px;">FOTO</th>
                                    <th style="width:205px;">NIS</th>
                                    <th style="width:258px;">NAMA</th>
                                    <th style="width:250px;">JENIS KELAMIN</th>
                                    <th style="width:210px;">TAHUN LULUS</th>
                                </tr>

                                <tr class="warning no-hasil bg-light">
                                      <td colspan="5">
                                          <i class="fas fa-warning text-warning"></i>
                                          Tidak ada hasil
                                          
                                      </td>                                    
                                </tr>

                            </thead>
                            <tbody>
                              @foreach ($alumni as $al)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                      @if ($al->foto)
                                        <div class="body-img" 
                                        style="width:45px;">
                                          <img src="{{ asset('storage/foto/siswa/' . $al->foto) }}">
                                        </div>
                                      @else
                                        <div class="body-img" 
                                        style="width:45px;">
                                          <img src="/img/i-people1.png">
                                        </div>
                                      @endif
                                        
                                    </td>
                                    <td>
                                      {{ $al->nis }}
                                    </td>
                                    <td>{{ $al->nama }}</td>
                                    <td>{{ (strtoupper($al->jenis_kelamin) == 'L') ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $al->tahun_lulus }}</td>
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
                    {!! $alumni->links(); !!}
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
    <script src="{{ asset('js/bs-animation.js') }}"></script>
    <script src="{{ asset('js/cari-data.js') }}"></script>
@endpush
