@extends('layouts.app')

@section('content')
<div id="backoffice_container">

    <div id="homepage_pages">
        <div class="homepage_pages_header">
            <h1>Contacta con nosotros</h1>
            <p>Si tienes alguna duda, sugerencia, o quieres mandarnos un mensaje, rellena el siguiente formulario</p>
        </div>
        <div class="homepage_pages_body">
            <div id="homepage_general">
                <div id="container">
                    <div id="container_form">
                        <form action="">
                            <input type="text" name="name" placeholder="Nombre">
                            <input type="email" name="email" placeholder="Correo electrónico">
                            <textarea name="mensaje" id="" cols="30" rows="10" maxlength="255"></textarea>
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
                        <p>978701213</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection