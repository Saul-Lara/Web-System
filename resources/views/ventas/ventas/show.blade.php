@extends('layouts.admin')

@section('titulo', 'Informacion de Venta')

@section('contenido')
        <div class="row">
            <div class="col-lg-3">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <p>{{$venta->nombre}}</p>
                      </div>

                      <div class="form-group">
                        <label>Tipo Comprobante</label>
                        <p>{{$venta->tipo_comprobante}}</p>
                      </div>

                      <div class="form-group">
                        <label for="serie_comprobante">Serie Comprobante</label>
                        <p>{{$venta->serie_comprobante}}</p>
                      </div>

                      <div class="form-group">
                        <label for="num_comprobante">Numero Comprobante</label>
                        <p>{{$venta->num_comprobante}}</p>
                      </div>

                  </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="block">
                  <div class="title"><strong>Detalles</strong></div>
                  <div class="table-responsive"> 
                    <table id="detalles" class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Precio Compra</th>
                          <th>Precio Venta</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th><h4 id="total">$ {{$venta->total_venta}}</h4></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($detalles as $detalle)
                        <tr>
                          <td>{{$detalle->articulo}}</td>
                          <td>{{$detalle->cantidad}}</td>
                          <td>{{$detalle->precio_venta}}</td>
                          <td>{{$detalle->descuento}}</td>
                          <td>{{$detalle->cantidad * ($detalle->precio_venta - $detalle->descuento)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
@endsection