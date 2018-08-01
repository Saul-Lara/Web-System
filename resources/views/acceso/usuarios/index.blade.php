@extends('layouts.admin')

@section('titulo', 'Usuarios')

@section('contenido')<a href="usuarios/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('acceso.usuarios.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{URL::action('UsuarioController@edit', $user->id )}}"><button class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    </td>
                                </tr>
                                
                                @include('acceso.usuarios.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $usuarios->render() }}

@endsection




