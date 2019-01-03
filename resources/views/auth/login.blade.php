@extends('layouts.template')

{{-- Nama untuk title bar --}}
@section("title" , "MIM Pucangan")
{{-- Nama untuk subtitle bar --}}
@section("subtitle" , "| Login")

@section('content')
<div class="container">
  <div class="row justify-content-center mt-5">
    {{-- .col-sm-6 my-4 --}}
    <div class="col-sm-6" style="max-width: 24em;margin: 4.5em 0 8em 0">

      <div class="card border border-primary mx-auto shadow">

        <div class="card-header text-center bg-primary">
          <img src="{{ asset('img/logopuc.png') }}" alt="Logo-Sekolah" 
          width="150" class="img-fluid">
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Username Field --}}
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text" id="username">
                  <i class="fas fa-envelope text-primary"></i></span>
              </div>
              <input id="email" type="email" class="form-control
              {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus 
              placeholder="Masukan Email">
              @if ($errors->has('email'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>

            {{-- Password Field --}}
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="password">
                  <i class="fas fa-lock text-primary"></i>
                </span>
              </div>
              <input id="password" type="password" class="form-control
              {{ $errors->has('password') ? ' is-invalid' : '' }}" 
              name="password" required placeholder="Masukan Password">
              @if ($errors->has('password'))
              <div class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </div>
              @endif
            </div>
            <hr>
            {{-- Button Field --}}
            <div class="form-group mb-0">
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Masuk
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
