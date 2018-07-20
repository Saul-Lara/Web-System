@extends('layouts.admin')

@section('titulo', 'Nuevo Ingreso')

@section('contenido')
        <div class="row">
            <div class="col-lg-12">
                @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        {!! Form::open(array('url' => 'compras/ingreso', 'method' => 'POST', 'autocomplete' => 'off')) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-4">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <select name="idproveedor" id="idproveedor" class="selectpicker form-control" data-live-search="true">
                          @foreach($personas as $persona)
                          <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tipo Comprobante</label>
                        <select name="tipo_comprobante" class="form-control">
                          <option value="Boleta">Boleta</option>
                          <option value="Factura">Factura</option>
                          <option value="Ticket">Ticket</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="serie_comprobante">Serie Comprobante</label>
                        <input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" placeholder="Serie del comprobante..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="num_comprobante">Numero Comprobante</label>
                        <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" placeholder="Numero del comprobante..." class="form-control">
                      </div>

                  </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="block">
                  <div class="block-body">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Ingreso de productos</h3>
                        </div>
                        <div class="panel-body">
                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Articulo</label>
                            <div class="col-sm-9">
                              <select name="pidarticulo" id="pidarticulo" class="selectpicker form-control" data-live-search="true">
                                @foreach($articulos as $articulo)
                                <option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Cantidad</label>
                            <div class="col-sm-9">
                              <input id="inputHorizontalWarning pcantidad" name="pcantidad" type="number" class="form-control form-control-warning" placeholder="Cantidad...">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Precio compra</label>
                            <div class="col-sm-9">
                              <input id="inputHorizontalWarning pprecio_compra" name="pprecio_compra" type="number" class="form-control form-control-warning" placeholder="Precio compra...">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Precio venta</label>
                            <div class="col-sm-9">
                              <input id="inputHorizontalWarning pprecio_venta" name="pprecio_venta" type="number" class="form-control form-control-warning" placeholder="Precio venta...">
                            </div>
                          </div>

                          <div class="form-group row">       
                            <div class="col-sm-9 offset-sm-3">
                              <button type="button" id="btn_add" class="btn btn-primary">Agregar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>Detalles</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Opciones</th>
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
                          <th></th>
                          <th><h4 id="total">$ 0.00</h4></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <div class="col-md-12">
              <div class="block">
                <div class="block-body">
                  <div class="form-group">
                    <input name="_token" value={{csrf_token()}} type="hidden"></input>      
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>

        {!! Form::close() !!}
@endsection