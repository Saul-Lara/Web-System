@extends('layouts.admin')

@section('titulo', 'Ventas')

@section('contenido')<a href="ventas/create" class="add pull-right"><button class="btn btn-primary">Agregar</button></a>
                    @include('ventas.ventas.search')
                
                    <div class="table-responsive"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
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
                            @foreach($ventas as $ven)
                                <tr>
                                    <td>{{ $ven->idingreso }}</td>
                                    <td>{{ $ven->fecha_hora }}</td>
                                    <td>{{ $ven->nombre }}</td>
                                    <td>{{ $ven->tipo_comprobante }}</td>
                                    <td>{{ $ven->serie_comprobante }}</td>
                                    <td>{{ $ven->num_comprobante }}</td>
                                    <td>{{ $ven->impuesto }}</td>
                                    <td>{{ $ven->total_venta }}</td>
                                    <td>{{ $ven->estado }}</td>
                                    <td>
                                        <a href="{{URL::action('VentaController@show', $ven->idingreso )}}"><button class="btn btn-primary">Detalles</button></a>
                                        <a href="" data-target="#modal-delete-{{$ven->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                                    </td>
                                </tr>
                                
                                @include('ventas.ventas.modal')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $ventas->render() }}

@endsection




