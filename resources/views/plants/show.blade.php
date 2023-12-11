@extends('layouts.app')
@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>{{ $plant->name }}</h2>
        <a class="btn btn-primary" href="{{ route('plants.index') }}">Atras</a>
    </div>
    <div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger ">
                <p>{{ $message }}</p>
            </div>
        @endif
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
    @if ($plant->status != 2)
        <div class="plant_container">
            <div class="plant_container_usuarios">
                <h3>Usuarios interesados</h3>

                <table class="table table-bordered">
                    <tr>
                        <th>Transaction id</th>
                        <th>Nombre de usuario</th>
                        <th>Transaction status id</th>
                        <th>Transaction active</th>
                        <th width="280px">Actiones</th>
                    </tr>
                    @if (count($listUsersWantPlant) > 0)
                        @foreach ($listUsersWantPlant as $user)
                        <tr>
                            <td>{{ $user->transaction_id }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>
                                
                                @if ($transactionTypeDictionary[$user->transaction_type_id])
                                    {{ $transactionTypeDictionary[$user->transaction_type_id] }}
                                @else
                                    {{ $user->transaction_type_id }}
                                @endif
                            </td>
                            <td>{{ $user->transaction_active }}</td>
                            <td class="lista_acciones">
                                @switch($user->transaction_type_id)
                                    @case(2)
                                        <a href="{{ route('transactions.choose',['transaction_id' => $user->transaction_id, 'plant_id' => $user->plant_id]) }}" title="Aceptar">
                                            <img class="icon enlace" src="{{ url('storage/icons/icono_pedido_aceptar.png') }}" alt="">
                                        </a>
                                        {{-- <a href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}" title="Rechazar">
                                            <img class="icon enlace" src="{{ url('storage/icons/icono_pedido_rechazar.png') }}" alt="">
                                        </a> --}}
                                        
                                        @break
                                    @case(3)
                                        @if ($transactionTypeDictionary[$user->transaction_type_id])
                                            {{ $transactionTypeDictionary[$user->transaction_type_id] }}
                                        @else
                                            {{ $user->transaction_type_id }}
                                        @endif
                                        @break
                                    @default
                                        <span class="status">Unknow: {{ $plant->transaction_type_id }}</span>
                                @endswitch
                                
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
    @else
    <div class="plant_container">
        <div class="plant_container_usuarios">
            <p>Esta planta fue entregada</p>
        </div>
    </div>
    @endif
</div>
@endsection