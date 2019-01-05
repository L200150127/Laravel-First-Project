{{-- .row#statistik --}}
<div class="row" id="statistik">
  <div class="col">
    <h2 class="text-center" 
    style="color:#0071ff; border-bottom: 2px solid #ff0f00">STATISTIK</h2>

    {{-- .card --}}
    <div class="card" style="border: none;">
      <div class="card-body" style="background-color:rgb(255,255,255);">
        <div class="row justify-content-center" 
        style="margin:0 -15px 15px -15px;padding:5px;">

          <div class="col-6 col-lg-4 col-xl-4">
              <h2 class="text-center h-text-statistik" style="font-size:26px;"><a href="/data-siswa"> SISWA </a></h2>
              <a href="/data-siswa"><img src="/img/peo2.jpg"></a>
              <h1 class="text-center" style="margin:10px 5px 0 5px;">
              {{ $siswaCount }}</h1>
          </div>

          <div class="col-lg-4 col-xl-4 offset-0" style="margin:5px 0;">
              <div class="mx-auto" id="icon-star"><a href="/prestasi-prestasi">
                <i class="far fa-star pulse animated infinite" style="font-size:79px;"></i></a>
              </div>
              <h1 class="text-center" style="margin:10px 5px 0 5px;">{{ $prestasiCount }}</h1>
          </div>

          <div class="col-6 col-lg-4 col-xl-4 offset-0">
              <h2 class="text-center h-text-statistik" style="font-size:26px;"> <a href="/data-guru"> GURU</a></h2>
              <a href="/data-guru"><img src="/img/peo1.jpg"></a>
              <h1 class="text-center" style="margin:10px 5px 0 5px;">
              {{ $guruCount }}</h1>
          </div>

        </div>
      </div>
    </div>{{-- /.card --}}
  </div>
</div>{{-- /.row#statistik --}}