@extends('layouts.admin')

@section('titulo', 'Ingresos')

@section('contenido')<a href="ingreso/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('compras.ingreso.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Serie Comprobante</th>
                                    <th>Numero Comprobante</th>
                                    <th>Impuesto</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ingresos as $ing)
                                <tr>
                                    <td>{{ $ing->idingreso }}</td>
                                    <td>{{ $ing->fecha_hora }}</td>
                                    <td>{{ $ing->nombre }}</td>
                                    <td>{{ $ing->tipo_comprobante }}</td>
                                    <td>{{ $ing->serie_comprobante }}</td>
                                    <td>{{ $ing->num_comprobante }}</td>
                                    <td>{{ $ing->impuesto }}</td>
                                    <td>{{ $ing->total }}</td>
                                    <td>{{ $ing->estado }}</td>
                                    <td>
                                        <a href="{{URL::action('IngresoController@show', $ing->idingreso )}}"><button class="btn btn-primary">Detalles</button></a>
                                        <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                                    </td>
                                </tr>
                                
                                @include('compras.ingreso.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $ingresos->render() }}

@endsection




