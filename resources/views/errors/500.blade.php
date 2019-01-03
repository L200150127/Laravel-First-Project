@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "Halaman Tidak Ditemukan")

{{-- scoped css --}}
@section('stylesheet')
    <!-- Custom styles 1 for this template -->
    <link rel="stylesheet" href="{{ asset('css/Navigation-Clean.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles-footer.css') }}">
    <!-- Custom styles 2 for this template -->
    <link rel="stylesheet" href="{{ asset('css/styles-error.css') }}">
@endsection

@section('content')
	{{-- Header --}}
	@include('partials._header_web')

	@component('components.error', [
		'src' => asset('img/500-error.png'),
		'alt' => 'Error-500-image'
	])
	@endcomponent
	{{-- Footer --}}
	@include('partials._footer_web')
@endsection

@push('scripts')
    <!-- core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" 
    charset="utf-8" async defer></script>
@endpush