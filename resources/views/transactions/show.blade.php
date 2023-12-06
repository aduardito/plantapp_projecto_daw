@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>Detalles de la Planta</h2>
        <a class="btn btn-primary" href="{{ route('transactions.search') }}">Atras</a>
    </div>
    <div class="plant_container_user">
        <div class="plant_container_image_user">
            <img src="{{ url( $plant->image_url) }}" alt="">
        </div>
        <div class="plant_container_details_user">
            <div >
                <h2>{{ $plant->name }}</h2>
            </div>
            <div>
                <p>{{ $plant->description }}</p>
            </div>
            {{-- <div>
                    <strong>Image url:</strong>
                    {{ $plant->image_url }}
            </div> --}}
        </div>
        
        
    </div>
</div>
@endsection