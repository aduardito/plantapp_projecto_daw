@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class=" action_header">
        <h2>Planta</h2>
        <a class="btn btn-primary" href="{{ route('plants.index') }}">Atras</a>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre de la planta:</strong>
                {{ $plant->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $plant->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image url:</strong>
                {{ $plant->image_url }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <img src="{{ url( $plant->image_url) }}" alt="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <a href="{{ url( $plant->image_url) }}" alt="">descargar</a>
            </div>
        </div>
    </div>
</div>
@endsection