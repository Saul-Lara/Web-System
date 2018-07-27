@extends('layouts.admin')

@section('titulo', 'Nuevo Ingreso')

@section('contenido')
        <div class="row">
            <div class="col-lg-3">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <p>{{$ingreso->nombre}}</p>
                      </div>

                      <div class="form-group">
                        <label>Tipo Comprobante</label>
                        <p>{{$ingreso->tipo_comprobante}}</p>
                      </div>

                      <div class="form-group">
                        <label for="serie_comprobante">Serie Comprobante</label>
                        <p>{{$ingreso->serie_comprobante}}</p>
                      </div>

                      <div class="form-group">
                        <label for="num_comprobante">Numero Comprobante</label>
                        <p>{{$ingreso->num_comprobante}}</p>
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
                          <th><h4 id="total">$ {{$ingreso->total}}</h4></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($detalles as $detalle)
                        <tr>
                          <td>{{$detalle->articulo}}</td>
                          <td>{{$detalle->cantidad}}</td>
                          <td>{{$detalle->precio_compra}}</td>
                          <td>{{$detalle->precio_venta}}</td>
                          <td>{{$detalle->cantidad * $detalle->precio_compra}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
@endsection