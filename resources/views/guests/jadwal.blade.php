@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , 'Jadwal ' . htmlspecialchars($kelas->nama))

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-jadwal.css') }}">
@endsection


@section('content')
  {{-- Header --}}
  @include('partials._header_web')

  

  {{-- Konten utama --}}
  <section id="tabel-data">
          <div class="container tabel-container">
            
            <div class="h1-judul">
              <h1 class="text-center"><strong>Jadwal Pelajaran</strong></h1>
              {{-- <p class="page-description text-center">Tahun Pelajaran 
                <span id="th"></span></p> --}}
              
            </div>

            

              <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="posisi-col">
                      <div id="text-walikelas">
                          <h6><span></span><strong>Wali 
                            {{ $kelas->nama }}</strong>
                            <span>
                              {{ $kelas->guru->nama }}
                            </span></h6>
                      </div>
                  </div>
              </div>
               <div class="row">
                <div class="col">
                    <div id="scrollbar">
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;SENIN</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($jadwalSenin as $senin)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($senin->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($senin->jam_selesai) ? 
                                               Carbon\Carbon::parse($senin->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $senin->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($senin->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;SELASA</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalSelasa as $selasa)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($selasa->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($selasa->jam_selesai) ? 
                                               Carbon\Carbon::parse($selasa->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $selasa->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($selasa->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;RABU</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalRabu as $rabu)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($rabu->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($rabu->jam_selesai) ? 
                                               Carbon\Carbon::parse($rabu->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $rabu->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($rabu->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;KAMIS</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalKamis as $kamis)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($kamis->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($kamis->jam_selesai) ? 
                                               Carbon\Carbon::parse($kamis->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $kamis->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($kamis->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;JUMAT</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalJumat as $jumat)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($jumat->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($jumat->jam_selesai) ? 
                                               Carbon\Carbon::parse($jumat->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $jumat->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($jumat->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="hari-jadwal">
                            <h5><span><i class="fa fa-book"></i></span><strong>&nbsp;SABTU</strong></h5>
                            <div class="table-responsive table-borderless hasilcari" id="tabel-font">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:155px;">Jam</th>
                                            <th style="width:350px;">Mata Pelajaran</th>
                                            <th style="width:343px;">Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalSabtu as $sabtu)
                                        <tr>
                                            <td>
                                              {{ 
                                                Carbon\Carbon::parse($sabtu->jam_mulai)->formatLocalized('%H:%I') 
                                               }} - 
                                              {{ ($sabtu->jam_selesai) ? 
                                               Carbon\Carbon::parse($sabtu->jam_selesai)->formatLocalized('%H:%I') : '' }}
                                            </td>
                                            <td>{{ $sabtu->mapel['nama'] }}</td>
                                            <td>
                                              @foreach ($sabtu->mapel['guru'] as $el)
                                                {{ $el->nama }}<br>
                                              @endforeach
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
