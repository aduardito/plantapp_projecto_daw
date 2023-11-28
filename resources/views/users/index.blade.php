@extends('layouts.app')


@section('content')
<div id="backoffice_container">
    <div class="action_header">
        <h2>Administración de Usuarios</h2>
        @can('role-create')
        <a class="btn btn-success" href="{{ route('users.create') }}">Crear Nuevo usuario</a>
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
    <th>User id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Roles</th>
    <th width="280px">Action</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <div>
                @if(!empty($user->getRoleNames()))
                    @forelse ($user->getRoleNames() as $role)
                        <span class="btn btn-success">{{ $role }}</span>

                    @empty
                        <span >No role</span>
                    @endforelse
                @endif
            </div> 
        </td>
        <td>
        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $data->render() !!}
</div>
@endsection
