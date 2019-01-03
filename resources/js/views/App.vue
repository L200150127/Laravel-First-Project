<template>
	<div>
	  <!-- Navbar -->
	  <nav class="main-header navbar navbar-expand navbar-light border-bottom shadow-sm bg-primary">
	    <!-- Left navbar links -->
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" data-widget="pushmenu" href="#">
	          <i class="fa fa-bars"></i></a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <router-link :to="{ name:'profil' }" class="nav-link">
	        Profil</router-link>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <router-link :to="{ name:'bantuan' }" class="nav-link">
	        Bantuan</router-link>
	      </li>
	    </ul>

	    <!-- SEARCH FORM -->
	    <!-- <form class="form-inline ml-3"> -->
	     <!--  <div class="input-group input-group-sm">
	        <input class="form-control form-control-navbar" type="search" placeholder="Masukan Pencarian" aria-label="Search"
	        @keyup="searchIt" v-model="search">
	        <div class="input-group-append">
	          <button class="btn btn-navbar" type="button" @click="searchIt">
	            <i class="fa fa-search"></i>
	          </button>
	        </div>
	      </div> -->
	    <!-- </form> -->

	    <!-- Right navbar links -->
	    <ul class="navbar-nav ml-auto">
	      <!-- Admin Dropdown Menu -->
	      <li class="nav-item dropdown" v-if="$gate.isAdmin()">
	        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
	        v-pre>
	            <span class="fas fa-ellipsis-v"></span>
	        </a>
	        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	          <router-link :to="{ name:'profil' }" 
	          class="dropdown-item d-sm-none d-inline-block black">
	            <i class="fas fa-user mr-2"></i>Profil
	          </router-link>
	          
	          <!-- Pengaturan Menu -->
	          <router-link :to="{ name:'pengaturan' }" class="dropdown-item black">
	            <i class="fas fa-cog mr-2"></i>Pengaturan
	          </router-link>
	          
	          <!-- Bantuan Menu -->
	          <router-link :to="{ name:'bantuan' }" class="dropdown-item d-sm-none d-inline-block black">
	            <i class="fas fa-question-circle mr-2"></i>Bantuan
	          </router-link>

	          <div class="dropdown-divider"></div>

	          <a class="dropdown-item black" href="/logout" 
	          @click.prevent="submitItem($event, form-id)">
	            <i class="fas fa-sign-out-alt"></i> 
	            Keluar
	          </a>
	        </div>
	      </li>

	      <!-- Logout -->
	      <li class="nav-item d-none d-sm-inline-block" v-if="$gate.isGuru()">
	        <button type="submit" class="nav-link" 
	        @click="submitItem($event, form-logout)">
	          <i class="fas fa-sign-out-alt"></i> 
	          <span class="text-responsive">Keluar</span>
	        </button>
	      </li>
	      <!-- Dropdown menu Guru -->
	      <li class="nav-item dropdown d-sm-none d-inline-block" 
	      v-if="$gate.isGuru()">
	        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
	        v-pre>
	            <span class="fas fa-ellipsis-v"></span>
	        </a>
	        <div class="dropdown-menu dropdown-menu-right" 
	        aria-labelledby="navbarDropdown">
	          <router-link :to="{ name:'profil' }" class="dropdown-item black">
	            <i class="fas fa-user mr-2"></i>Profil
	          </router-link>
	          
	          <!-- Bantuan Menu -->
	          <router-link :to="{ name:'bantuan' }" class="dropdown-item black">
	            <i class="fas fa-question-circle mr-2"></i>Bantuan
	          </router-link>

	          <div class="dropdown-divider"></div>

	          <a class="dropdown-item black" href="/logout" 
	          @click.prevent="submitItem($event, form-logout)">
	            <i class="fas fa-sign-out-alt"></i> 
	            Keluar
	          </a>
	        </div>
	      </li>

	      <form id="logout-form" action="/logout" method="POST" 
	      style="display: none;">
	        <input type="hidden" name="_token" :value="csrfToken">
	      </form>
	    </ul>
	  </nav><!-- /.navbar --> 

	  <!-- Main Sidebar Container -->
	  <aside class="main-sidebar sidebar-light-primary elevation-2" 
	  style="z-index: 1010">
	    <!-- Brand Logo -->
	    <a href="/home" class="brand-link bg-primary">
	      <img :src="logoSekolah" alt="Logo Situs" class="brand-image">
	      <span class="brand-text font-weight-light">MIM Pucangan</span>
	    </a> 

	    <!-- Sidebar -->
	    <div class="sidebar">
	      <!-- Sidebar user panel (optional) -->
	      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image pt-1">
	          <!-- <img :src="user.photo" alt="Gambar User"> -->
	          <img :src="userPhotoDefault" alt="Gambar Default User">
	        </div>
	        <div class="info">
	          <router-link :to="{ name:'profil' }" class="d-block pt-1">
	              <!-- {{ user.name | capitalize }} -->
	              Lyon
	          </router-link>
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

	          <!-- User menu -->
	          <li class="nav-item" v-if="$gate.isAdmin()">
	            <router-link :to="{ name:'users' }" class="nav-link">
	              <i class="nav-icon fas fa-users text-warning"></i>
	              <p>User</p>
	            </router-link>
	          </li>

	          <!-- Artikel menu -->
	          <li class="nav-item has-treeview">
	            <router-link :to="{ name:'artikel' }" class="nav-link">
	              <i class="nav-icon fas fa-newspaper" 
	              style="color: turquoise"></i>
	              <p>
	                Artikel <i class="right fas fa-angle-left"></i>
	              </p>
	            </router-link>
	            <ul class="nav nav-treeview">
	              <li class="nav-item">
	                <router-link :to="{ name:'tambahartikel' }" class="nav-link">
	                  <i class="fas fa-pencil-alt nav-icon"></i>
	                  <p>Buat Artikel</p>
	                </router-link>
	              </li>
	              <li class="nav-item">
	                <router-link :to="{ name:'kategori' }" class="nav-link">
	                  <i class="fas fa-tags nav-icon"></i>
	                  <p>Buat Kategori</p>
	                </router-link>
	              </li>
	            </ul>
	          </li>
	          
	          <!-- Data Guru menu -->
	          <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
	            <router-link :to="{ name:'guru' }" class="nav-link">
	            <i class=" nav-icon fas fa-chalkboard-teacher" 
	            style="color: cyan"></i>
	            <p>Guru <i class="right fas fa-angle-left"></i></p>
	            </router-link>
	            <ul class="nav nav-treeview">
	              <li class="nav-item">
	                <router-link :to="{ name:'tambahguru' }" class="nav-link">
	                  <i class="fas fa-pencil-alt nav-icon"></i>
	                  <p>Tambah Guru</p>
	                </router-link>
	              </li>
	            </ul>
	          </li>

	          <!-- Data Siswa menu -->
	          <li class="nav-item has-treeview" v-if="$gate.isAdmin()">
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
	                <router-link :to="{ name:'mapel' }" class="nav-link">
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

	          <!-- Prestasi menu -->
	          <li class="nav-item">
	            <router-link :to="{ name:'prestasi' }" class="nav-link">
	              <i class=" nav-icon fas fa-trophy" style="color:gold"></i>
	              <p>Prestasi</p>
	            </router-link>
	          </li>

	          <!-- Galeri Foto menu -->
	          <li class="nav-item">
	            <router-link :to="{ name:'galeri' }" class="nav-link">
	              <i class=" nav-icon fas fa-images" 
	              style="color: deepskyblue"></i>
	              <p>Galeri Foto</p>
	            </router-link>
	          </li>
	          
	          <!-- Agenda menu -->
	          <li class="nav-item" v-if="$gate.isAdmin()">
	            <router-link :to="{ name:'agenda' }" class="nav-link">
	              <i class=" nav-icon fas fa-calendar-alt" 
	              style="color: palegreen"></i>
	              <p>Agenda</p>
	            </router-link>
	          </li>

	          <!-- Dana Bantuan menu -->
	          <li class="nav-item" v-if="$gate.isAdmin()">
	            <router-link :to="{ name:'danabantuan' }" class="nav-link">
	              <i class=" nav-icon fas fa-hands-helping" 
	              style="color: wheat"></i>
	              <p>Dana Bantuan</p>
	            </router-link>
	          </li>

	        </ul>
	      </nav>
	      <!-- /.sidebar-menu -->
	    </div>
	    <!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Admin</h1>
	          </div><!-- /.col -->

	          <!-- <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item">Dashboard</li>
	            </ol>
	          </div> --><!-- /.col -->
	        </div><!-- /.row -->
	        <hr>
	      </div><!-- /.container-fluid -->
	    </div>

	    <!-- /.content-header --> <!-- Main content -->
	    <div class="content">
	      <div class="container-fluid">
	        <!-- route outlet --> <!-- component matched by the route will render here -->
	        <transition name="fade">
	          <keep-alive>
	            <router-view></router-view>
	          </keep-alive>
	        </transition>

	        <!-- set progressbar -->
	        <vue-progress-bar></vue-progress-bar>
	        
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content -->

	  </div>
	  
	  <!-- /.content-wrapper --> <!-- Main Footer -->
	  <footer class="main-footer">
	    <!-- To the right -->
	    <div class="float-right d-none d-sm-inline">
	      
	    </div>
	    <!-- Default to the left -->
	    <strong>
	      Copyright &copy; 2018 MIM Pucangan.
	    </strong> All rights reserved.
	  </footer>
  </div>
</template>

<style>
  .fade-enter-active {
    transition: opacity 1s .2s;
  }
  .fade-enter {
    opacity: 0;
  }
</style>

<script>
  export default {
    data() {
      return {
        csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        logoSekolah: 'img/logopuc.png',
        userPhotoDefault: 'svg/user.svg',
        user: {},

      }
    },
    methods: {
        submitItem(evt, formId){
            evt.preventDefault();
            document.getElementById(formId).submit();
        }
    }
  };
</script>