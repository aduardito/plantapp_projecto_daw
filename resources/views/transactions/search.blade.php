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
        <form action="" method="GET">
            <input type="text" name="plant_name" placeholder="Nombre de la planta" id="" value="{{ $plant_name == null ? '' : $plant_name }}">
            <div>
                {!! Form::label('transaction_type_id', 'Estado', ) !!}
                {!! Form::select('transaction_type_id', $transaction_types, $transaction_type_id == null ? -1 : $transaction_type_id, ) !!}
            </div>


            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>



    <div id="container_plants">



        @forelse ($plants as $plant)

            <div class="card">
                <div class="container_image">
                    <img src="{{ url( $plant->plant_image_url) }}" alt="" title="" class="img_pri" />
                </div>
                
                <h3>{{ ucfirst($plant->plant_name) }}</h3>
                {{-- <h4>ID: {{ $plant->plant_id }}</h4> --}}
                <p>{{ Str::limit( $plant->plant_description, 60) }}</p>

                <div class="plant_card_button">
                    <a class="btn btn-info" href="{{ route('transactions.show',['plant_id' => $plant->plant_id]) }}">Show</a>

                    @if ($plant->transaction_id == null or $plant->plant_transaction_user_id != Auth::id())
                        <a class="btn btn-primary" href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}">Favorita</a>
                        <a class="btn btn-primary" href="{{ route('transactions.request',['plant_id' => $plant->plant_id]) }}">La quiero</a>
                    @else
                        @switch($transaction_types[$plant->transaction_type_id])
                            @case('like')
                                
                                <span class="status"><i class="bi bi-chat-left-heart"></i>Me gusta</span>
                                <a class="btn btn-primary" href="{{ route('transactions.request',['plant_id' => $plant->plant_id]) }}">La quiero</a>
                                @break
                
                            @case('wants')
                                <span class="status"><i class="bi bi-cart"></i>La pedí</span>
                                <a class="btn btn-primary" href="{{ route('transactions.like',['plant_id' => $plant->plant_id]) }}">Favorita</a>
                                @break
                            @case('granted')
                                <span class="status"><i class="bi bi-cart-check"></i>Serás el nuevo dueno</span>
                                @break
                            @case('given_away')
                                <span class="status">La planta es tuya</span>
                                @break
                            @default
                                <span class="status">Unknow</span>
                        @endswitch


                    @endif
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