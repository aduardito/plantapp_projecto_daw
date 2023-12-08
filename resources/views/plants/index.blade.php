@extends('layouts.app')


@section('content')


<div id="backoffice_container">
    <div class=" action_header">
        <h2>Plantas</h2>
        <a class="btn btn-primary" href="{{ route('plants.create') }}">Crea tu nueva planta</a>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            
            <th>Nombre</th>
            <th>Descripción</th>
            @role('Admin')
            <th>User id</th>
            <th>No</th>
            <th>Fecha actualización</th>
            @endrole
            <th width="280px">Action</th>
        </tr>
	    @forelse ($plants as $plant)
	    <tr>
	        
	        <td>{{ $plant->name }}</td>
	        <td>{{ Str::limit($plant->description, 40)  }}</td>
            @role('Admin')
            <td>{{ $plant->user_id }}</td>
            <td>{{ $plant->id }}</td>
            <td>{{ $plant->updated_at }}</td>
            @endrole


	        <td class="lista_acciones">
                <a class="btn btn-info" href="{{ route('plants.show',$plant->id) }}">
                    <img class="icon pulsa" src="{{ url('storage/icons/icono_pedido_detalle.png') }}" alt="">
                </a>
                @can('plant-edit')
                {{-- <a class="btn btn-primary" href="{{ route('plants.edit',$plant->id) }}">Edit</a> --}}
                @endcan


                @csrf
                @method('DELETE')
                @can('plant-delete')
                    {!! Form::open(['method' => 'POST','route' => ['plants.destroy',$plant->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-danger">
                            <img class="icon" src="{{ url('storage/icons/icono_pedido_borrar.png') }}" alt="">
                        </button>
                    {!! Form::close() !!}
                @endcan
	        </td>
        </td>


	    </tr>
	    @empty
            <tr>
                <th>No hay plantas en la base de datos</th></tr>
        @endforelse
    </table>


    {!! $plants->links() !!}
</div>
@endsection