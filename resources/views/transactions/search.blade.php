@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Busca Plantas</h2>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div>
        <form action="" method="GET">
            {!! Form::label('plant_name', 'Nombre de la Planta') !!}
            <input type="text" name="plant_name" id="" value="{{ $plant_name == null ? '' : $plant_name }}">
            {!! Form::label('transaction_type_id', 'Estado de la transacción', ) !!}
            {!! Form::select('transaction_type_id', $transaction_types, $transaction_type_id == null ? -1 : $transaction_type_id, ) !!}
            {!! Form::submit('busca') !!}
        </form>
    </div>

    <table class="table table-bordered">
        <tr>
            
            <th>Nombre</th>
            <th>User id</th>
            @role('Admin')
            <th>No</th>
            <th>Fecha actualización</th>
            @endrole
            <th width="280px">Action</th>
        </tr>
	    @forelse ($plants as $plant)
	    <tr>
	        
	        <td>{{ $plant->name }}</td>
	        <td>{{ $plant->user_id }}</td>
            @role('Admin')
            <td>{{ $plant->id }}</td>
            <td>{{ $plant->updated_at }}</td>
            @endrole
	        <td>
                    <a class="btn btn-info" href="{{ route('plants.show',$plant->id) }}">Show</a>

                    @if ($plant->transaction_id == null)
                        <a class="btn btn-primary" href="{{ route('transactions.like',['plant_id' => $plant->id]) }}">Like</a>
                        <a class="btn btn-primary" href="{{ route('transactions.request',['plant_id' => $plant->id]) }}">Request</a>
                    @else
                        @switch($transaction_types[$plant->transaction_type_id])
                            @case('like')
                                <span class="status">LIKE</span>
                                <a class="btn btn-primary" href="{{ route('transactions.request',['plant_id' => $plant->id]) }}">Request</a>
                                @break
                
                            @case('wants')
                                <span class="status">WANT</span>
                                <a class="btn btn-primary" href="{{ route('transactions.like',['plant_id' => $plant->id]) }}">Like</a>
                                @break
                            @case('granted')
                                <span class="status">GRANTED</span>
                                @break
                            @case('given_away')
                                <span class="status">GIVEN_AWAY</span>
                                @break
                            @default
                                <span class="status">Unknow</span>
                        @endswitch


                    @endif

                    
	        </td>
	    </tr>
	    @empty
            <tr><th colspan=3>
                @switch($transaction_types[$transaction_type_id])
                @case('like')
                    <p>No te ha gustado ninguna planta todavía <a  href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('wants')
                    <p>No has pedido ninguna planta todavía <a href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('granted')
                    <p>No te han escogido como nuevo owner de plantas que has pedido <a href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @case('given_away')
                    <p>No tienes plantas donadas todavía <a href="{{ route('transactions.search') }}">Busca plantas</a></p>
                    @break
                @default
                    <p>No hay plantas en la base de datos <a href="{{ route('transactions.search') }}">Busca plantas</a></p>
            @endswitch                
                
            </th>   </tr>
        @endforelse
    </table>


    {{-- {!! $plants->links() !!} --}}

@endsection