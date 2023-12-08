@extends('layouts.app')

@section('content')


<div id="form_login_plantapp">
    <div id="form_login_plantapp_page_title">
        <h1>Registro de nuevo usuario</h1>
    </div>
    <div id="form_login_plantapp_con">
        <div id="form_login_plantapp_img">
            <img src="{{ url('storage/homepage/planta_cuatro.jpg') }}" alt="">
        </div>
        <div id="form_login_plantapp_form">
            
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
                    <input id="email" type="email" placeholder="Correo Electrónico"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <div class="login_input">
        
                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <div class="login_input">
                    <input id="password-confirm" placeholder="Repite la contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
        
                <div class="login_input login_button">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
        
                    <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
        
        
            </form>
        </div>
    </div>
    
    
</div>




@endsection
