@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>Modifica tu planta</h2>
        <a class="btn btn-primary" href="{{ route('plants.index') }}">Atrás</a>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('plants.update',$plant->id) }}" method="POST">
    	@csrf
        @method('PUT')

        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $plant->name }}">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Descripcion:</strong>
		            <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ $plant->description }}</textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Imagen:</strong>
		            <input type="text" name="image_url" class="form-control" placeholder="Name" value="{{ $plant->image_url }}">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-primary">Borrar datos</button>
		    </div>
		</div>
    </form>
</div>
@endsection