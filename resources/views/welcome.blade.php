<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles --><!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
     

        <div id="homepage_grid">

            <div id="homepage_billboard">
                <img src="{{ url('storage/homepage/billboard_plantapp.jpg') }}" alt="" title="" class="img_pri" />         
            </div>
            <div id="homepage_servicios">
                <h2>Para que podemos utilizar esta página</h2>
                <div id="homepage_servicios_cards">
                    <div class="card"><p>Compartir plantas</p></div>
                    <div class="card"><p>Conocer gente con los mismos gustos</p></div>
                    <div class="card"><p>Aprender sobre cuidados de tus plantas</p></div>
                    <div class="card"><p>Aprender sobre cuidados de tus plantas</p></div>
                </div>
            </div>

        </div>

        <div id="homepage_login_links">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="">Visitar mi página</a>
                    @else
                        <a href="{{ route('login') }}" class="">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">Register</a>
                        @endif
                    @endauth
                </div>
            @endif   

        </div>   
        
        <div id="homepage_general_contact_form">
            <div id="homepage_general">
                <div id="container">
                    <div id="container_form">
                        <h1>Contacta con nosotros</h1>
                        <p>Si tienes alguna duda, sugerencia, o quieres mandarnos un mensaje, rellena el siguiente formulario</p>
                        <form action="">
                            <input type="text" name="name" placeholder="Nombre">
                            <input type="email" name="email" placeholder="Correo electrónico">
                            <textarea name="mensaje" id="" cols="30" rows="10"></textarea>
                            <button type="submit" name="send">Enviar</button>
                        </form>
                    </div>
                    <div id="container_black"></div>
                </div>
                <div id="container_info">
                    <img src="{{ url('storage/homepage/homepage_contactus.png') }}" alt="">
                    <div id="background"></div>
                    <div>
                        <h1>PlantApp</h1>
                        <p>Calle falsa, 23</p>
                        <p>servicio@plantapp.es</p>
                        <p>987654312</p>
                    </div>
                    
                </div>
            </div>
        </div> 

    </body>
</html>
