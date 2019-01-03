@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Admin")
{{-- Nama untuk subtitle bar --}}
@section("subtitle" , "| Dashboard")

@section('bodyClass', 'hold-transition sidebar-mini')

@section('content')
  <div class="wrapper" id="app">
    
    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-light border-bottom shadow-sm bg-primary">
      {{-- Left navbar links --}}
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <router-link to="/profil" class="nav-link">Profil</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <router-link to="/bantuan" class="nav-link">Bantuan</router-link>
        </li>
      </ul>

      {{-- SEARCH FORM --}}
      {{-- <form class="form-inline ml-3"> --}}
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Masukan Pencarian" aria-label="Search"
          @keyup="searchIt" v-model="search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="button" @click="searchIt">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      {{-- </form> --}}

      {{-- Right navbar links --}}
      <ul class="navbar-nav ml-auto">
        {{-- Admin Dropdown Menu --}}
        <li class="nav-item dropdown" v-if="$gate.isAdmin()">
          <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <span class="fas fa-ellipsis-v"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <router-link to="/profil" 
            class="dropdown-item d-sm-none d-inline-block black">
              <i class="fas fa-user mr-2"></i>Profil
            </router-link>
            {{-- File Manajer Menu --}}
            {{-- <router-link to="/media" class="dropdown-item">
              <i class="fas fa-archive mr-2"></i>File Manajer
            </router-link> --}}
            
            {{-- Pengaturan Menu --}}
            <router-link to="/pengaturan" class="dropdown-item black">
              <i class="fas fa-cog mr-2"></i>Pengaturan
            </router-link>
            
            Bantuan Menu
            <router-link to="/bantuan" class="dropdown-item d-sm-none d-inline-block black">
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
        </li>

        {{-- Logout --}}
        <li class="nav-item d-none d-sm-inline-block" v-if="$gate.isGuru()">
          <a class="nav-link" href="{{ route('logout') }}" 
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> 
            <span class="text-responsive">Keluar</span>
          </a>
        </li>
        {{-- Dropdown menu Guru --}}
        <li class="nav-item dropdown d-sm-none d-inline-block" 
        v-if="$gate.isGuru()">
          <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <span class="fas fa-ellipsis-v"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <router-link to="/profil" class="dropdown-item black">
              <i class="fas fa-user mr-2"></i>Profil
            </router-link>
            
            {{-- Bantuan Menu --}}
            <router-link to="/bantuan" class="dropdown-item black">
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
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </ul>
    </nav>{{-- /.navbar --}} 

    {{-- Main Sidebar Container --}}
    <aside class="main-sidebar sidebar-light-primary elevation-2" style="z-index: 1010">
      {{-- Brand Logo --}}
      <a href="/home" class="brand-link bg-primary">
        <img src="{{ asset('img/logopuc.png') }}" alt="Logo Situs" 
        class="brand-image" style="opacity: .8;">
        <span class="brand-text font-weight-light">MIM Pucangan</span>
      </a> 

      {{-- Sidebar --}}
      <div class="sidebar">
        {{-- Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image pt-1">
            @if (!empty(Auth::user()->photo))
              <img src="{{ asset(Auth::user()->photo) }}" alt="Gambar User Admin">
            @else
              <img src="{{ asset('svg/user.svg') }}" alt="Gambar User Admin">
            @endif
          </div>
          <div class="info">
            <router-link to="/profil" class="d-block">
                {{ ucwords(Auth::user()->name) }}
            </router-link>
          </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" 
          data-widget="treeview" role="menu" data-accordion="true">
            {{-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library --}}

            {{-- Dashboard menu --}}
            <li class="nav-item">
              <router-link to="/home" class="nav-link">
                <i class="nav-icon fas fa-home" style="color: chartreuse"></i>
                <p>Dashboard</p>
              </router-link>
            </li>

            @can('isAdmin')
            {{-- User menu --}}
            <li class="nav-item">
              <router-link to="/users" class="nav-link">
                <i class="nav-icon fas fa-users text-warning"></i>
                <p>User</p>
              </router-link>
            </li>
            @endcan

            {{-- Artikel menu --}}
            <li class="nav-item has-treeview">
              <router-link to="/artikel" class="nav-link">
                <i class="nav-icon fas fa-newspaper" 
                style="color: turquoise"></i>
                <p>
                  Artikel <i class="right fas fa-angle-left"></i>
                </p>
              </router-link>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/artikel/tambah-artikel" class="nav-link">
                    <i class="fas fa-pencil-alt nav-icon"></i>
                    <p>Buat Artikel</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/artikel/kategori" class="nav-link">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>Buat Kategori</p>
                  </router-link>
                </li>
              </ul>
            </li>
            
            @can('isAdmin')
            {{-- Data Guru menu --}}
            <li class="nav-item has-treeview">
              <router-link to="/guru" class="nav-link">
              <i class=" nav-icon fas fa-chalkboard-teacher" 
              style="color: cyan"></i>
              <p>Guru <i class="right fas fa-angle-left"></i></p>
              </router-link>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/guru/tambah-guru" class="nav-link">
                    <i class="fas fa-pencil-alt nav-icon"></i>
                    <p>Tambah Guru</p>
                  </router-link>
                </li>
              </ul>
            </li>
            @endcan

            @can('isAdmin')
            {{-- Data Siswa menu --}}
            <li class="nav-item has-treeview">
              <router-link to="/siswa" class="nav-link">
              <i class=" nav-icon fas fa-book-reader" 
              style="color: lightsalmon"></i>
              <p>Siswa
                {{-- <span class="right badge badge-danger">New</span> --}}
                <i class="right fas fa-angle-left"></i>
              </p>
              </router-link>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/siswa/tambah-siswa" class="nav-link">
                    <i class="fas fa-pencil-alt nav-icon"></i>
                    <p>Tambah Siswa</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/siswa/alumni" class="nav-link">
                    <i class="fas fa-user-graduate nav-icon"></i>
                    <p>Daftar Alumni</p>
                  </router-link>
                </li>
              </ul>
            </li>
            @endcan

            {{-- Mata Pelajaran menu --}}
            <li class="nav-item has-treeview">
              <router-link to="/kelas" class="nav-link">
              <i class=" nav-icon fas fa-chalkboard" style="color: skyblue"></i>
                <p>Kelas
                  {{-- <span class="right badge badge-danger">New</span> --}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </router-link>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/kelas/mapel" class="nav-link">
                    <i class="fas fa-book nav-icon"></i>
                    <p>Mata Pelajaran</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/kelas/materi" class="nav-link">
                    <i class="fas fa-upload nav-icon"></i>
                    <p>Materi Pendukung</p>
                  </router-link>
                </li>
              </ul>
            </li>

            {{-- Prestasi menu --}}
            <li class="nav-item">
              <router-link to="/prestasi" class="nav-link">
                <i class=" nav-icon fas fa-trophy" 
                style="color:gold"></i>
                <p>Prestasi</p>
              </router-link>
            </li>

            {{-- Galeri Foto menu --}}
            <li class="nav-item">
              <router-link to="/galeri" class="nav-link">
                <i class=" nav-icon fas fa-images" style="color: deepskyblue"></i>
                <p>Galeri Foto</p>
              </router-link>
            </li>
            
            @can('isAdmin')
            {{-- Agenda menu --}}
            <li class="nav-item">
              <router-link to="/agenda" class="nav-link">
                <i class=" nav-icon fas fa-calendar-alt" 
                style="color: palegreen"></i>
                <p>Agenda</p>
              </router-link>
            </li>

            {{-- Dana Bantuan menu --}}
            <li class="nav-item">
              <router-link to="/dana_bantuan" class="nav-link">
                <i class=" nav-icon fas fa-hands-helping" 
                style="color: wheat"></i>
                <p>Dana Bantuan</p>
              </router-link>
            </li>
            @endcan

          </ul>
        </nav>
        {{-- /.sidebar-menu --}}
      </div>
      {{-- /.sidebar --}}
    </aside>

    {{-- Content Wrapper. Contains page content --}}
    
    <div class="content-wrapper">
      {{-- Content Header (Page header) --}}
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin</h1>
            </div>{{-- /.col --}}
            {{-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Dashboard</li>
              </ol>
            </div> --}}{{-- /.col --}}
          </div>{{-- /.row --}}
          <hr>
        </div>{{-- /.container-fluid --}}
      </div>

      {{-- /.content-header --}} {{-- Main content --}}
      <div class="content">
        <div class="container-fluid">
          {{-- route outlet --}} {{-- component matched by the route will render here --}}
          <transition name="fade">
            <router-view></router-view>
          </transition>

          {{-- set progressbar --}}
          <vue-progress-bar></vue-progress-bar>
          
        </div>{{-- /.container-fluid --}}
      </div>
      {{-- /.content --}}

    </div>
    
    {{-- /.content-wrapper --}} {{-- Main Footer --}}
    <footer class="main-footer">
      {{-- To the right --}}
      <div class="float-right d-none d-sm-inline">
        
      </div>
      {{-- Default to the left --}}
      <strong>
        Copyright &copy; 2018 MIM Pucangan.
      </strong> All rights reserved.
    </footer>
  </div>
  {{-- ./wrapper --}} 
@endsection

@push('scripts')
    @auth
      <script type="text/javascript">
        window.user = @json(auth()->user())
      </script>
    @endauth
    <!-- core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- REQUIRED SCRIPTS --}} 
    {{-- Compiled Script --}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8"></script>
    
@endpush
