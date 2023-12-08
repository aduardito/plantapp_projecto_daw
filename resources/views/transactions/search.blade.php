@extends('layouts.app')
@section('content')
<div id="backoffice_container">
    <h1>Busca Plantas</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="plant_search_form">
        {!! Form::open(['method' => 'get']) !!}
            <input type="text" name="plant_name" placeholder="Nombre de la planta" id="" value="{{ $plant_name == null ? '' : $plant_name }}">
            <div>
                {!! Form::label('transaction_type_id', 'Estado', ) !!}
                {!! Form::select('transaction_type_id', $transaction_types, $transaction_type_id == null ? -1 : $transaction_type_id, ) !!}
            </div>
            <button type="submit" class="btn btn-primary">
                Probar suerte
            </button>
        {!! Form::close() !!}

        {{-- <form action="" method="GET">
            <input type="text" name="plant_name" placeholder="Nombre de la planta" id="" value="{{ $plant_name == null ? '' : $plant_name }}">
            <div>
                {!! Form::label('transaction_type_id', 'Estado', ) !!}
                {!! Form::select('transaction_type_id', $transaction_types, $transaction_type_id == null ? -1 : $transaction_type_id, ) !!}
            </div>
            <button type="submit" class="btn btn-primary">Probar suerte</button>
        </form> --}}
    </div>



    <div id="container_plants">



        @forelse ($plants as $plant)

            <div class="card">
                <div class="container_image">
                    <img src="{{ url( $plant->plant_image_url) }}" alt="" title="" class="img_pri" />
                </div>
                <div class="container_plant_details">
                    <div>
                        <h3>{{ ucfirst($plant->plant_name) }}</h3>
                    </div>
                    <div>
                        {{-- <h4>ID: {{ $plant->plant_id }}</h4> --}}
                        <p>{{ Str::limit( $plant->plant_description, 60) }}</p>
                    </div>
                    

                    <div class="plant_card_button">
                            <a class="btn btn-light" href="{{ route('transactions.show',['plant_id' => $plant->plant_id]) }}"  title="Ver detalles">
                                <img class="icon" src="{{ url('storage/icons/icono_pedido_detalle.png') }}" alt="">
                            </a>
                      

                        @if ($plant->transaction_id == null or $plant->plant_transaction_user_id != Auth::id())
                            <a class="btn btn-light" href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}"  title="Guarda en Favoritos">
                                <img class="icon" src="{{ url('storage/icons/icono_planta_favorito_negro.png') }}" alt="">
                            </a>
                            <a class="btn btn-light" href="{{ route('transactions.request',['plant_id' => $plant->plant_id]) }}" title="Pídeme">
                                <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_uno.png') }}" alt="">
                            </a>
                        @else
                            @switch($plant->transaction_type_id)
                                @case(1)
                                    <a class="btn btn-light" href="" title="En favoritos">
                                        <img class="icon" src="{{ url('storage/icons/icono_panta_fav_rojo_lleno.png') }}" alt="En favoritos">
                                    </a>
                                    <a class="btn btn-light"  href="{{ route('transactions.request',['plant_id' => $plant->plant_id]) }}" title="Pídeme">
                                        <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_uno.png') }}" alt="">
                                    </a>
                                    @break
                    
                                @case(2)
                                    <a class="btn btn-light" href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}"  title="Guarda en Favoritos">
                                        <img class="icon" src="{{ url('storage/icons/icono_planta_favorito_negro.png') }}" alt="">
                                    </a>
                                    <a class="btn btn-light" href="" title="Pedida">
                                        <img class="icon" src="{{ url('storage/icons/icono_pedido_paso_dos.png') }}" alt="">
                                    </a>
                                    
                                    @break
                                @case(3)
                                    <span class="status"><img class="icon" src="{{ url('storage/icons/icono_pedido_paso_tres.png') }}" alt=""></span>
                                    @break
                                @case(4)
                                    <span class="status"><img class="icon" src="{{ url('storage/icons/icono_pedido  _paso_cuatro.png') }}" alt=""></span>
                                    @break
                                @default
                                    <span class="status">Unknow: {{ $plant->transaction_type_id }}</span>
                            @endswitch


                        @endif
                    </div>
                </div>
                

                
                
            </div>
	    
	    @empty
            <tr><th colspan=3>
                @switch($transaction_types[$transaction_type_id])
                @case('like')
                    <p>No te ha gustado ninguna planta todavía <a class="btn btn-info" href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('wants')
                    <p>No has pedido ninguna planta todavía <a class="btn btn-info" href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('granted')
                    <p>No te han escogido como nuevo owner de plantas que has pedido <a class="btn btn-info" href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('given_away')
                    <p>No tienes plantas donadas todavía <a class="btn btn-info" href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @default
                    <p>No hay plantas en la base de datos <a class="btn btn-info" href="{{ route('transactions.search') }}">Busca plantas</a></p>
            @endswitch                
                
            </th>   </tr>
        @endforelse
    </div>
</div>
@endsection