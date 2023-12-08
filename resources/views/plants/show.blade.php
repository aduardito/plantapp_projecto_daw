@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>Detalles de la Planta</h2>
        <a class="btn btn-primary" href="{{ route('plants.index') }}">Atras</a>
    </div>
    <div class="plant_container">
        <div class="plant_container_details">
            <div >
                    <strong>Nombre de la planta:</strong>
                    {{ $plant->name }}
            </div>
            <div>
                    <strong>Description:</strong>
                    {{ $plant->description }}
            </div>
            <div>
                    <strong>Image url:</strong>
                    {{ $plant->image_url }}
            </div>
        </div>
        <div class="plant_container_image">
            
            <div>
                <img src="{{ url( $plant->image_url) }}" alt="">
            </div>
            <div>
                <a href="{{ url( $plant->image_url) }}" alt="">descargar imagen</a>
            </div>
        </div>
        
    </div>
    <div class="plant_container">
        <div class="plant_container_usuarios">
            <h3>Usuarios interesados</h3>

            <table class="table table-bordered">
                <tr>
                    <th>Transaction id</th>
                    <th>Nombre de usuario</th>
                    <th width="280px">Actiones</th>
                </tr>
                @if (count($listUsersWantPlant) > 0)
                    @foreach ($listUsersWantPlant as $user)
                    <tr>
                        <td>{{ $user->transaction_id }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>
                            <a href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}" title="Aceptar"><img class="icon enlace" src="{{ url('storage/icons/icono_pedido_aceptar.png') }}" alt=""></a>
                            <a href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}" title="Rechazar"><img class="icon enlace" src="{{ url('storage/icons/icono_pedido_rechazar.png') }}" alt=""></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No hay usuarios</td>
                    </tr>
                @endif
                
            </table>
        </div>
    </div>
</div>
@endsection