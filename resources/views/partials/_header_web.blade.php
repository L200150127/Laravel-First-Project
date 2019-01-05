{{--   #nav-atas --}}
  <section id="nav-atas">
      <nav class="navbar navbar-light navbar-expand-md" 
      style="background-color:#ef7800;padding:0px;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" 
          style="padding:0px;color:rgba(255,255,255,0.9);">
            <i class="fa fa-star"></i>
            <strong>&nbsp;AKREDITASI B&nbsp;</strong>
            <i class="fa fa-star"></i>
          </a>

          <a class="anim" href="#" style="color:#ffe500;">
            <marquee>
              <strong>Selamat Datang di Website MIM Pucangan</strong>
            </marquee>
          </a>
          
          <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item" role="presentation">
                <a class="nav-link" href="#" 
                style="margin:3px 3px;">
                  <strong>081-393-686-626</strong>
                </a>
              </li>

              <li class="nav-item" role="presentation">
                <a class="nav-link" href="#" style="margin:3px 3px;">
                  <strong>Facebook</strong>
                </a>
              </li>

              <li class="nav-item" role="presentation">
                <a class="nav-link" href="#" style="margin:3px 3px;">
                  <strong>Instagram</strong>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  </section>{{-- /#nav-atas --}}

  {{-- #jumbotron-a --}}
  <section id="jumbotron-a">
    <div id="bg-jumbotron">
      <div class="jumbotron">
        <img src="{{ asset('img/logopuc.png') }}" alt="" class="logo2">
        <h1 >MIM PUCANGAN</h1>
        <p >Characteristic Islamic School </p>
        <div class="lay1 w-100" >
        <img src="{{ asset('img/logopuc.png') }}" ><span>Characteristic Islamic School</span>
        </div>
        
      </div>
    </div>
  </section>{{-- /#jumbotron-a --}}

  {{-- #nav-baw --}}
  <section id="nav-baw">
    <nav class="navbar navbar-expand-lg navbar-light">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">
              HOME
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdownMenuLink" 
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              PROFIL
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/visi-misi">Visi & Misi</a>
              <a class="dropdown-item" href="/janji-muhammadiyah">
                Janji Pelajar Muhammadiyah</a>
              <a class="dropdown-item" href="/struktur">
                Struktur Organisasi</a>
              <a class="dropdown-item" href="/izin-operasional">
                Izin Operasonal</a>
              <a class="dropdown-item" href="/dana-bantuan">Dana</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.semua') }}">ARTIKEL</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdownMenuLink" 
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> DATA SEKOLAH</a>
            
            <div class="dropdown-menu" 
            aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/data-guru">Data Guru</a>
              <a class="dropdown-item" href="/data-siswa">Data Siswa</a>
              <a class="dropdown-item mb-2" href="/data-alumni">Data Alumni</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link " href="javascript:void(0)" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">JADWAL</a>
            
            <div class="dropdown-menu" 
            aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/jadwal-kelas/1">Kelas 1</a>
              <a class="dropdown-item" href="/jadwal-kelas/2">Kelas 2</a>
              <a class="dropdown-item" href="/jadwal-kelas/3">Kelas 3</a>
              <a class="dropdown-item" href="/jadwal-kelas/4">Kelas 4</a>
              <a class="dropdown-item" href="/jadwal-kelas/5">Kelas 5</a>
              <a class="dropdown-item mb-2" href="/jadwal-kelas/6">Kelas 6</a>

            </div>
          </li>
            
          <li class="nav-item">
              <a class="nav-link " href="/unduh-materi" >MATERI</a>
          </li>

          <li class="nav-item">
              <a class="nav-link " href="/album-foto">GALERI</a>
          </li>

          <li class="nav-item">
              <a class="nav-link after-none" href="/kontak">KONTAK</a>
          </li>
        </ul>
      </div>

    </nav>
  </section>{{-- /#nav-baw --}}