@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Plantas</h2>
            </div>
            <div class="pull-right">
                @can('plant-create')
                <a class="btn btn-success" href="{{ route('plants.create') }}"> Crea la nueva planta</a>
                @endcan
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
                <form action="{{ route('plants.destroy',$plant->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('plants.show',$plant->id) }}">Show</a>
                    @can('plants-edit')
                    <a class="btn btn-primary" href="{{ route('plants.edit',$plant->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('plant-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @empty
            <tr>
                <th>No hay plantas en la base de datos</th></tr>
        @endforelse
    </table>


    {!! $plants->links() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection