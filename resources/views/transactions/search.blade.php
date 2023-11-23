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
    @endif


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

                    @if ($plant->transaction_id == null))
                        <span>no hay entry en plant_transactions table</span>
                    @else
                        <span>hay entry</span>
                    @endif

                    <a class="btn btn-primary" href="{{ route('transactions.like',['plant_id' => $plant->id]) }}">Like</a>
                    <a class="btn btn-primary" href="{{ route('transactions.request',['plant_id' => $plant->id]) }}">Request</a>
	        </td>
	    </tr>
	    @empty
            <tr>
                <th>No hay plantas en la base de datos</th></tr>
        @endforelse
    </table>


    {{-- {!! $plants->links() !!} --}}

@endsection