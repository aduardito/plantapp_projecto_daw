@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Planta</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('plants.index') }}"> Atrás</a>
            </div>
        </div>
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
@endsection