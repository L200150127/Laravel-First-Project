@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Admin")
{{-- Nama untuk subtitle bar --}}
@section("subtitle" , "| Dashboard")

@section('bodyClass', 'hold-transition sidebar-mini')

@section('stylesheet')
@endsection

@section('content')
  <div class="wrapper" id="app">
      
      {{-- Navbar --}}
      @include('partials._nav_admin')

      {{-- Main Sidebar Container --}}
      @include('partials._sidebar_admin')

      {{-- Content Wrapper. Contains page content --}}
      
      <div class="content-wrapper">

        {{-- Content Header (Page header) --}}
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">

              <div class="col-sm-12">
                <h1 class="m-0 text-dark animated fadeInLeft" v-cloak>
                  @{{ $route.meta.title }}
                </h1>
              </div>{{-- /.col --}}

            </div>{{-- /.row --}}
            <hr>
          </div>{{-- /.container-fluid --}}
        </div>{{-- /.content-header --}}

        {{-- Main content --}}
        <div class="content">
          <div class="container-fluid">
            {{-- route outlet --}} {{-- component matched by the route will render here --}}
            <transition name="router-anim" enter-active-class="animated fadeInRight" leave-active-class="animated fadeOutRight">
              <keep-alive>
                <router-view></router-view>
              </keep-alive>
            </transition>

            {{-- set progressbar --}}
            <vue-progress-bar></vue-progress-bar>
            
          </div>{{-- /.container-fluid --}}
        </div>{{-- /.content --}}
        </scroll-bar>

      </div>{{-- /.content-wrapper --}}

      {{-- Main Footer --}}
      @include('partials._footer_admin')
  </div>{{-- ./wrapper --}} 
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
    <script src="{{ asset('js/app.js') }}" type="text/javascript" 
    charset="utf-8"></script>
@endpush