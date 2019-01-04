<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light border-bottom shadow-sm bg-primary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    {{-- <li class="nav-item d-none d-sm-inline-block">
      <router-link :to="{ name:'profil' }" class="nav-link">Profil</router-link>
    </li> --}}
    {{-- <li class="nav-item d-none d-sm-inline-block">
      <router-link :to="{ name:'bantuan' }" class="nav-link">
      Bantuan</router-link>
    </li> --}}
  </ul>

  <!-- SEARCH FORM -->
  <!-- <form class="form-inline ml-3"> -->
    <div class="input-group input-group-sm pl-3">
      <input class="form-control form-control-navbar" type="search" placeholder="Masukan Pencarian" aria-label="Search"
      @keyup="searchIt" v-model="search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="button" @click="searchIt">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  <!-- </form> -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Admin Dropdown Menu -->
    {{-- <li class="nav-item dropdown" v-if="$gate.isAdmin()">
      <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          <span class="fas fa-ellipsis-v"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <router-link :to="{ name:'profil' }" 
        class="dropdown-item d-sm-none d-inline-block black">
          <i class="fas fa-user mr-2"></i>Profil
        </router-link>
        <!-- File Manajer Menu -->
        <router-link to="/media" class="dropdown-item">
          <i class="fas fa-archive mr-2"></i>File Manajer
        </router-link>
        
        Pengaturan Menu
        <router-link :to="{ name:'pengaturan' }" class="dropdown-item black">
          <i class="fas fa-cog mr-2"></i>Pengaturan
        </router-link>
        
        <!-- Bantuan Menu -->
        <router-link :to="{ name:'bantuan' }" class="dropdown-item d-sm-none d-inline-block black">
          <i class="fas fa-question-circle mr-2"></i>Bantuan
        </router-link>

        <div class="dropdown-divider"></div>

        <a class="dropdown-item black" href="{{ route('logout') }}" 
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> 
          Keluar
        </a>
      </div>
    </li> --}}

    <!-- Logout -->
    <li class="nav-item {{-- d-none d-sm-inline-block --}}" {{-- v-if="$gate.isGuru()" --}}>
      <a class="nav-link" href="{{ route('logout') }}" 
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> 
        <span class="text-responsive">Keluar</span>
      </a>
    </li>
    <!-- Dropdown menu Guru -->
    {{-- <li class="nav-item dropdown d-sm-none d-inline-block" 
    v-if="$gate.isGuru()">
      <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          <span class="fas fa-ellipsis-v"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <router-link :to="{ name:'profil' }" class="dropdown-item black">
          <i class="fas fa-user mr-2"></i>Profil
        </router-link>
        
        <!-- Bantuan Menu -->
        <router-link :to="{ name:'bantuan' }" class="dropdown-item black">
          <i class="fas fa-question-circle mr-2"></i>Bantuan
        </router-link>

        <div class="dropdown-divider"></div>
        
        <a class="dropdown-item black" href="{{ route('logout') }}" 
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> 
          Keluar
        </a>
      </div>
    </li> --}}

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </ul>
</nav><!-- /.navbar --> 