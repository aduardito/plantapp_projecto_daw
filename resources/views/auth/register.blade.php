@extends('layouts.app')

@section('content')



<div id="form_login">
    <h1>Registro de nuevo usuario</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="login_input">
            <input id="name" placeholder="Nombre Completo" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="login_input">
            <input id="email" type="email" placeholder="Correo Electronico"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="login_input">

            <input id="password" type="password" placeholder="Contrasenia" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="login_input">
            <input id="password-confirm" placeholder="Repite la contrasenia" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="login_input login_button">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>

            <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>


    </form>
</div>



@endsection
