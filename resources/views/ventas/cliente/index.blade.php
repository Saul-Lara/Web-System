@extends('layouts.admin')

@section('titulo', 'Clientes')

@section('contenido')<a href="cliente/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('ventas.cliente.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Tipo Doc.</th>
                                    <th>Num Doc.</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($personas as $per)
                                <tr>
                                    <td>{{ $per->idpersona }}</td>
                                    <td>{{ $per->nombre }}</td>
                                    <td>{{ $per->tipo_documento }}</td>
                                    <td>{{ $per->num_documento }}</td>
                                    <td>{{ $per->telefono }}</td>
                                    <td>{{ $per->email }}</td>
                                    <td>
                                        <a href="{{URL::action('ClienteController@edit', $per->idpersona )}}"><button class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    </td>
                                </tr>
                                
                                @include('ventas.cliente.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $personas->render() }}

@endsection




