@extends('layouts.app')

@section('content')
<div id="backoffice_container">

    <div class=" action_header">
        <h2>Publica tu nueva plant</h2>
        <a class="btn btn-primary" href="{{ route('plants.index') }}">Atrás</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ohh!</strong> Ha habido un problema.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nombre:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Nombre de la planta">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Descripción:</strong>
		            <textarea class="form-control" style="height:150px" name="description" placeholder="Detail" maxlength="250"></textarea>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Imagen:</strong>
		            <input type="file" name="image_url" class="form-control" placeholder="Seleciona el archivo con la imagen de tu planta">
                    @error('image_url')
                        <div class="alert alert-danger mt-1 mb-1">{{ message }}</div>
                    @enderror
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