<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    {{-- Charset fot HTML5 UTF-8 meta tag --}}
    <meta charset="utf-8">

    {{-- Responsive viewport meta tag --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    {{-- document additional info meta tag --}}
    <meta name="description" content="@yield('deskripsiMeta', 'Dokumen')">
    <meta name="author" content="Lyon">

    {{-- HTML5 Edge compatibility meta tag --}}
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icon Titlebar --}}
    <link rel="icon" type="image/png" 
    href="{{ asset('img/icon/favicon-32x32.png') }}" sizes="32x32" />

    {{-- Window Titlebar --}}
    <title>@yield('title', 'Judul') @yield('subtitle')</title>
    
    {{-- dns prefetch fonts --}}
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{-- Compiled Stylesheet --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    {{-- Local / Scoped stylesheet --}}
    @yield('stylesheet')
  </head>
  <body class="@yield('bodyClass', 'root')">
  {{-- konten --}}
    @yield("content")
  {{-- akhir dari main --}}
  @stack('scripts')
  </body>
</html>
