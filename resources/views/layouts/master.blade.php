<!DOCTYPE html>
{{--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Admin Dashboard</title>
  {{-- Compiled Stylesheet --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  {{-- Navbar --}}
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    {{-- Left navbar links --}}
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    {{-- SEARCH FORM --}}
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    {{-- Right navbar links --}}
    <ul class="navbar-nav ml-auto">
      {{-- Messages Dropdown Menu --}}
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            {{-- Message Start --}}
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Agok</p>
              </div>
            </div>
            {{-- Message End --}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            {{-- Message Start --}}
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            {{-- Message End --}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            {{-- Message Start --}}
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            {{-- Message End --}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      {{-- Notifications Dropdown Menu --}}
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  {{-- /.navbar --}}

  {{-- Main Sidebar Container --}}
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Brand Logo --}}
    <a href="/home" class="brand-link">
    <img src="{{ asset('img/admin.svg') }}" alt="Logo Situs" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">StartUp.</span><span class="brand-text font-weight-light text-primary">Inc</span>
    </a>

    {{-- Menambahkan credit --}}
    {{-- <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="User">User</a> from <a href="https://www.flaticon.com/"     title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"     title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> --}}
    
    {{-- Sidebar --}}
    <div class="sidebar">
      {{-- Sidebar user panel (optional) --}}
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user_admin.svg') }}" class="img-circle elevation-2" alt="Gambar User Admin">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      {{-- Sidebar Menu --}}
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library --}}
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Artikel
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="#" class="nav-link">
                  <i class="fas fa-pencil-alt nav-icon"></i>
                  <p>Buat Artikel</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class=" nav-icon fas fa-images"></i>
              <p>
                Galeri Foto
              </p>
            </router-link>
          </li>
          <li class="nav-item">
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class=" nav-icon fas fa-clipboard-list"></i>
              <p>
                Agenda
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class=" nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Data Guru
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class=" nav-icon fas fa-book-reader"></i>
              <p>
                Data Siswa
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="#" class="nav-link">
              <i class=" nav-icon fas fa-archive"></i>
              <p>
                File Manajer
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class=" nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-power-off"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
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
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div>{{-- /.col --}}
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div>{{-- /.col --}}
        </div>{{-- /.row --}}
      </div>{{-- /.container-fluid --}}
    </div>
    {{-- /.content-header --}}

    {{-- Main content --}}
    <div class="content">
      <div class="container-fluid">
        {{-- route outlet --}}
        {{-- component matched by the route will render here --}}
        <router-view></router-view>
      </div>{{-- /.container-fluid --}}
    </div>
    {{-- /.content --}}
  </div>
  {{-- /.content-wrapper --}}


  {{-- Main Footer --}}
  <footer class="main-footer">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
{{-- ./wrapper --}}

{{-- REQUIRED SCRIPTS --}}

{{-- Compiled Script --}}
<script src="{{ asset('js/app.js') }}"></script> 
</body>
</html>
