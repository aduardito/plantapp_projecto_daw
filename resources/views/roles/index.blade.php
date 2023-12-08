@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class="action_header">
        <h2>Roles</h2>
        @can('role-create')
        <a class="btn btn-primary" href="{{ route('roles.create') }}">Crear Nuevo rol</a>
        @endcan
    </div>
    


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td class="lista_acciones">
                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">
                    <img class="icon" src="{{ url('storage/icons/icono_pedido_detalle.png') }}" alt="">
                </a>
                @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">
                        <img class="icon" src="{{ url('storage/icons/icono_pedido_editar.png') }}" alt="">
                    </a>
                @endcan
                @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn btn-danger"><img class="icon" src="{{ url('storage/icons/icono_pedido_borrar.png') }}" alt=""></button>
                    {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </table>


    {!! $roles->render() !!}

</div>
@endsection