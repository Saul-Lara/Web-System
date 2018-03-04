@extends('layouts.admin')

@section('titulo', 'Articulos')

@section('contenido')<a href="articulo/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('almacen.articulo.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($articulos as $art)
                                <tr>
                                    <td>{{ $art->idarticulo }}</td>
                                    <td>{{ $art->nombre }}</td>
                                    <td>{{ $art->codigo }}</td>
                                    <td>{{ $art->categoria }}</td>
                                    <td>{{ $art->stock }}</td>
                                    <td><img src='{{ asset('imagenes/articulos/'.$art->imagen) }}' alt='{{ $art->nombre }}' height="100px" width="100px" class="img-thumbnail" ></td>
                                    <td>{{ $art->estado }}</td>
                                    <td>
                                        <a href="{{URL::action('ArticuloController@edit', $art->idarticulo )}}"><button class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    </td>
                                </tr>
                                
                                @include('almacen.articulo.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $articulos->render() }}

@endsection




