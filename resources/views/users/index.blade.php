@extends('adminlte::page')

@section('title', 'Usuarios')
@section('content')


<div class="card">
    
    <div class="card-body">
        <table id="users" class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">
                    @foreach($user->getRoleNames() as $rolName)
                                <span class="badge badge-dark">{{ $rolName }}</span>
                            @endforeach
                    </td>
                    <td class="align-middle">
                    <a href="{{ route('users.show', $user->id) }}" role="button" class="btn btn-dark display:inline">Ver</a>
                    <a href="{{ route('users.edit', $user->id) }}" role="button" class="btn btn-info display:inline">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline' ]) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#users').DataTable();
    </script>
@stop