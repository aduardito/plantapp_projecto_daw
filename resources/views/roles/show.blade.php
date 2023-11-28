@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class="action_header">
        <h2>Ver permisos del rol: {{ $role->name }}</h2>
        <a class="btn btn-primary" href="{{ route('roles.index') }}">Atras</a>
    </div>


    <div class="form-group">
        <strong>Permisos:</strong>
        @if(!empty($rolePermissions))
            @foreach($rolePermissions as $v)
                <label class="label label-success">{{ $v->name }},</label>
            @endforeach
        @endif
    </div>

</div>
@endsection