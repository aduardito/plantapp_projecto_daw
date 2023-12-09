@extends('layouts.app')

@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>{{ $plant->name }}</h2>
        <a class="btn btn-primary" href="{{ route('transactions.search') }}">Atras</a>
    </div>
    
    <div class="acciones_plant_transaction">
        @if ($transactions && count($transactions) == 1)
            <div class="acciones_plant_transaction_header">Que has hecho con planta</div>
                <div class="plant_container_transaction_steps">
                    @foreach ($transactions as $transaction)
                        @switch($transaction->transaction_type_id)
                            @case(1) 
                            {{-- like --}}
                                <div  class="transaction_action">
                                    <div class="transaction_action_header">En favoritos</div>
                                    <div class="transaction_action_body">
                                        <a class="btn btn-light" href="" title="Favorita">
                                            <img class="icon" src="{{ url('storage/icons/icono_panta_fav_rojo_lleno.png') }}" alt="">
                                        </a>
                                    </div>
                                    
                                </div>

    
                                @break
                
                            @case(2)
                                {{-- wants --}}
                                <div  class="transaction_action">
                                    <div class="transaction_action_header">Planta Pedida</div>
                                    <div class="transaction_action_body">
                                        <a class="btn btn-light" href="" title="Pedida">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_dos.png') }}" alt="">
                                        </a>
                                    </div>
                                    
                                </div>
                                @break
                            @case(3)
                            {{-- tu seras el nuevo dueno --}}
                                <div  class="transaction_action">
                                    <div class="transaction_action_header">Planta Pedida</div>
                                    <div class="transaction_action_body">
                                        <a class="btn" href="" title="Pedida">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_dos.png') }}" alt="">
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="transaction_action">
                                    <div class="transaction_action_header">Quieren entregarte la planta</div>
                                    <div class="transaction_action_body">
                                        <a class="btn" href="" title="Te han escogido">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_tres.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                {{-- <span class="status"><img class="icon" src="{{ url('storage/icons/icono_pedido_paso_tres.png') }}" alt=""></span> --}}
                                @break
                            @case(4)
                                <div  class="transaction_action">
                                    <div class="transaction_action_header">Planta Pedida</div>
                                    <div class="transaction_action_body">
                                        <a class="btn" href="" title="Pedida">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_dos.png') }}" alt="">
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="transaction_action">
                                    <div class="transaction_action_header">Quieren entregarte la planta</div>
                                    <div class="transaction_action_body">
                                        <a class="btn" href="" title="Te han escogido">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_tres.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="transaction_action">
                                    <div class="transaction_action_header">Planta Entregada</div>
                                    <div class="transaction_action_body">
                                        <a class="btn" href="" title="Planta Entregada">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_cuatro.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                @break
                            @default
                                <span class="status">Unknow: {{ $plant->transaction_type_id }}</span>
                        @endswitch
                    @endforeach
                </div>
            </div> 
        @endif
            

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
        </div>
        
    </div>


    <div class="acciones_plant_transaction">

        @if ($transactions && count($transactions) == 1)
            <div class="acciones_plant_transaction_header">Decide que hacer</div>
                <div class="plant_container_transaction_steps">
                    @foreach ($transactions as $transaction)
                        @switch($transaction->transaction_type_id)
                            @case(1) 
                            {{-- like --}}
                                <div class="transaction_action">
                                    <div class="transaction_action_body">
                                        <a class="btn btn-light" href="{{ route('transactions.spdislike',['plant_id' => $plant->id]) }}" title="Quitar de favoritos">
                                            <img class="icon" src="{{ url('storage/icons/icono_planta_favorito_negro.png') }}" alt="En favoritos">
                                        </a>
                                        <a class="btn" href="{{ route('transactions.spwant',['plant_id' => $plant->id]) }}" title="Pedir">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_uno.png') }}" alt="">
                                        </a>
                                    </div>

                                </div>

    
                                @break
                
                            @case(2)
                                {{-- wants --}}
                                <div class="transaction_action">
                                    <div class="transaction_action_body">
                                        {{-- <a class="btn btn-light" href="" title="Marcar como favorita">
                                            <img class="icon" src="{{ url('storage/icons/icono_panta_fav_rojo_lleno.png') }}" alt="">
                                        </a> --}}
                                        <a class="btn btn-light" href="{{ route('transactions.spunwant',['plant_id' => $plant->id]) }}" title="Rechazar pedido">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_rechazar.png') }}" alt="Rechazar">
                                        </a>
                                    </div>
                                </div>
                                @break
                            @case(3)
                            {{-- tu seras el nuevo dueno --}}
                                <div class="transaction_action">
                                    <div class="transaction_action_body">
                                        {{-- <a class="btn btn-light" href="" title="Marcar como favorita">
                                            <img class="icon" src="{{ url('storage/icons/icono_panta_fav_rojo_lleno.png') }}" alt="">
                                        </a> --}}
                                        <a class="btn btn-light" href="{{ route('transactions.spreject',['plant_id' => $plant->id]) }}" title="Rechazar entrega">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_rechazar.png') }}" alt="Rechazar">
                                        </a>
                                        <a class="btn btn-light" href="{{ route('transactions.spaccept',['plant_id' => $plant->id]) }}" title="Aceptar entrega">
                                            <img class="icon" src="{{ url('storage/icons/icono_pedido_aceptar.png') }}" alt="Rechazar">
                                        </a>
                                        
                                    </div>
                                </div>                            
                                {{-- <span class="status"><img class="icon" src="{{ url('storage/icons/icono_pedido_paso_tres.png') }}" alt=""></span> --}}
                                @break
                        @endswitch

                    @endforeach
                </div>
            </div>
        @else
            <div class="acciones_plant_transaction_header">Acciones sobre esta planta 1</div>
                <div class="plant_container_transaction_steps">
                    <div class="transaction_action">
                        <div class="transaction_action_body">
                            {{-- {{ dd($plant->id) }} --}}
                            <a class="btn btn-light" href="{{ route('transactions.splike',['plant_id' => $plant->id]) }}" title="Marcar como Favorita">
                                <img class="icon" src="{{ url('storage/icons/icono_panta_fav_rojo_lleno.png') }}" alt="En favoritos">
                            </a>
                            <a class="btn" href="{{ route('transactions.spwant',['plant_id' => $plant->id]) }}" title="Pedir planta">
                                <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_uno.png') }}" alt="">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endif
            
    </div>            
    
</div>
@endsection