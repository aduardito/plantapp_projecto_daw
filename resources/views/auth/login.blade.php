@extends('layouts.app')

@section('content')
    
    
    <div id="form_login_plantapp">
        <div id="form_login_plantapp_page_title">
            <h1>Login</h1>
        </div>
        <div id="form_login_plantapp_con">
            <div id="form_login_plantapp_img">
                <img src="{{ url('storage/homepage/planta_uno.jpg') }}" alt="">
            </div>
            <div id="form_login_plantapp_form">
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="login_input">
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="login_input">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="login_input login_button">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvidaste tu contraseña?') }}
                            </a>
                        @endif

                        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Si todavía no tienes cuenta, Registrarte') }}</a>
                    </div>


                </form>
            </div>
        </div>
        
        
    </div>


@endsection
