<!-- main-sidebar -->
<aside class="main-sidebar sidebar-light-primary elevation-2">

  <!-- Brand Logo -->
  <a href="/home" class="brand-link bg-primary">
    <img src="{{ asset('img/logopuc.png') }}" alt="Logo Situs" 
    class="brand-image" style="opacity: .8;">
    <span class="brand-text font-weight-light">MIM Pucangan</span>
  </a> 

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image pt-1">
        @if (!empty(Auth::user()->photo))
          <img src="/storage/foto/user/{{ Auth::user()->photo }}" alt="Gambar User Admin">
        @else
          <img src="/storage/default/svg/user.svg" alt="Gambar User Admin">
        @endif
      </div>
      <div class="info">
            <a href="#">{{ ucwords(Auth::user()->name) }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" 
      data-widget="treeview" role="menu" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        <!-- Dashboard menu -->
        <li class="nav-item">
          <router-link :to="{ name:'home' }" class="nav-link">
            <i class="nav-icon fas fa-home" style="color: chartreuse"></i>
            <p>Dashboard</p>
          </router-link>
        </li>

        @can('isAdmin')
        <!-- User menu -->
        <li class="nav-item">
          <router-link :to="{ name:'users' }" class="nav-link">
            <i class="nav-icon fas fa-users text-warning"></i>
            <p>User</p>
          </router-link>
        </li>
        @endcan

        <!-- Artikel menu -->
        <li class="nav-item has-treeview">
          <router-link :to="{ name:'artikel' }" class="nav-link" exact>
            <i class="nav-icon fas fa-newspaper" 
            style="color: turquoise"></i>
            <p>
              Artikel <i class="right fas fa-angle-left"></i>
            </p>
          </router-link>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link :to="{ name:'tambahartikel' }" class="nav-link" exact>
                <i class="fas fa-pencil-alt nav-icon"></i>
                <p>Buat Artikel</p>
              </router-link>
            </li>
          </ul>
        </li>
        
        @can('isAdmin')
        <!-- Data Guru menu -->
        <li class="nav-item has-treeview">
          <router-link :to="{ name:'guru' }" class="nav-link" exact>
          <i class=" nav-icon fas fa-chalkboard-teacher" 
          style="color: navajowhite"></i>
          <p>Guru <i class="right fas fa-angle-left"></i></p>
          </router-link>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link :to="{ name:'tambahguru' }" class="nav-link" exact>
                <i class="fas fa-pencil-alt nav-icon"></i>
                <p>Tambah Guru</p>
              </router-link>
            </li>
          </ul>
        </li>
        @endcan

        @can('isAdmin')
        <!-- Data Siswa menu -->
        <li class="nav-item has-treeview">
          <router-link :to="{ name:'siswa' }" class="nav-link">
          <i class=" nav-icon fas fa-book-reader" 
          style="color: lightsalmon"></i>
          <p>Siswa
            <!-- <span class="right badge badge-danger">New</span> -->
            <i class="right fas fa-angle-left"></i>
          </p>
          </router-link>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link :to="{ name:'tambahsiswa' }" class="nav-link">
                <i class="fas fa-pencil-alt nav-icon"></i>
                <p>Tambah Siswa</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name:'alumni' }" class="nav-link">
                <i class="fas fa-user-graduate nav-icon"></i>
                <p>Daftar Alumni</p>
              </router-link>
            </li>
          </ul>
        </li>
        @endcan
        
        @can('isAdmin')
        <!-- Mata Pelajaran menu -->
        <li class="nav-item has-treeview">
          <router-link :to="{ name:'kelas' }" class="nav-link">
          <i class=" nav-icon fas fa-chalkboard" style="color: skyblue"></i>
            <p>Kelas
              <!-- <span class="right badge badge-danger">New</span> -->
              <i class="right fas fa-angle-left"></i>
            </p>
          </router-link>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <router-link :to="{ name:'jadwal' }" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Jadwal Pelajaran</p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name:'materi' }" class="nav-link">
                <i class="fas fa-upload nav-icon"></i>
                <p>Materi Pendukung</p>
              </router-link>
            </li>
          </ul>
        </li>
        @endcan
        
        @can('isGuru')
        <li class="nav-item">
          <router-link :to="{ name:'materi' }" class="nav-link">
            <i class="fas fa-upload nav-icon" style="color: skyblue"></i>
            <p>Materi Pendukung</p>
          </router-link>
        </li>
        @endcan
        <!-- Prestasi menu -->
        <li class="nav-item">
          <router-link :to="{ name:'prestasi' }" class="nav-link">
            <i class=" nav-icon fas fa-trophy" 
            style="color:gold"></i>
            <p>Prestasi</p>
          </router-link>
        </li>

        <!-- Galeri Foto menu -->
        <li class="nav-item">
          <router-link :to="{ name:'galeri' }" class="nav-link">
            <i class=" nav-icon fas fa-images" style="color: deepskyblue"></i>
            <p>Galeri Foto</p>
          </router-link>
        </li>
        
        @can('isAdmin')
        <!-- Agenda menu -->
        <li class="nav-item">
          <router-link :to="{ name:'agenda' }" class="nav-link">
            <i class=" nav-icon fas fa-calendar-alt" 
            style="color: palegreen"></i>
            <p>Agenda</p>
          </router-link>
        </li>

        <!-- Dana Bantuan menu -->
        <li class="nav-item">
          <router-link :to="{ name:'danabantuan' }" class="nav-link">
            <i class=" nav-icon fas fa-hands-helping" 
            style="color: wheat"></i>
            <p>Dana Bantuan</p>
          </router-link>
        </li>
        @endcan

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside><!-- /main-sidebar -->