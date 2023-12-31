<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name', 'Plantapp') }}</title>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Plant App
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
  
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
  
                    </ul>
  
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else

                            @role('Admin')
                                <li class="nav-item">
                                    <li><a class="nav-link" href="{{ route('users.index') }}">Usuarios</a></li>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <li><a class="nav-link" href="{{ route('plants.index') }}">Plantas</a></li>
                                </li>

                            @endrole

                            @role('User')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('plants.index') }}">Mis plantas</a>
                                </li>
                                <li class="nav-item">
                                    <li><a class="nav-link" href="{{ route('transactions.search') }}">Busca plantas</a></li>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('transactions.search', ['transaction_type_id' => 1]) }}">Favorita</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('transactions.search', ['transaction_type_id' => 2]) }}">Peticion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('transactions.search', ['transaction_type_id' => 3]) }}">Negociacion</a>
                                </li> --}}
                                
                            @endrole


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}  ({{ Auth::user()->id }})
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
  
        <main class="main_body">
            <div class="container_body">
                @yield('content')
            </div>
        </main>
          
    </div>
</body>
</html>