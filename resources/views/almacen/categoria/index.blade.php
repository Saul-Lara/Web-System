@extends('layouts.admin')

@section('titulo', 'Categorias')

@section('contenido')<a href="categoria/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('almacen.categoria.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categorias as $cat)
                                <tr>
                                    <td>{{ $cat->idcategoria }}</td>
                                    <td>{{ $cat->nombre }}</td>
                                    <td>{{ $cat->descripcion }}</td>
                                    <td>
                                        <a href="{{URL::action('CategoriaController@edit', $cat->idcategoria )}}"><button class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    </td>
                                </tr>
                                
                                @include('almacen.categoria.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categorias->render() }}

@endsection




