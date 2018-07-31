@extends('layouts.admin')

@section('titulo', 'Nueva venta')

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
        {!! Form::open(array('url' => 'ventas/ventas', 'method' => 'POST', 'autocomplete' => 'off')) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-4">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select name="idcliente" id="idcliente" class="selectpicker form-control" data-live-search="true">
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
                                <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Cantidad</label>
                            <div class="col-sm-9">
                              <input id="pcantidad" name="pcantidad" type="number" class="form-control form-control-warning" placeholder="Cantidad...">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Stock</label>
                            <div class="col-sm-9">
                              <input id="pstock" name="pstock" disabled type="number" class="form-control form-control-warning" placeholder="Cantidad...">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Precio venta</label>
                            <div class="col-sm-9">
                              <input id="pprecio_venta" disabled name="pprecio_venta" type="number" class="form-control form-control-warning" placeholder="Precio venta...">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Descuento</label>
                            <div class="col-sm-9">
                              <input id="pdescuento" name="pdescuento" type="number" class="form-control form-control-warning" placeholder="Descuento...">
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
                    <table id="detalles" class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Precio Venta</th>
                          <th>Descuento</th>
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
                          <th><h4 id="total">$ 0.00</h4><input type="hidden" id="total_venta" name="total_venta"></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <div class="col-md-12" id="guardar">
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
@push('scripts')
<script>
  $(document).ready(function(){
    $("#btn_add").click(function(){
      agregar();
    });
  });

  var cont = 0;
  total = 0;
  subtotal = [];
  
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);

  function mostrarValores(){
    datosArticulo = document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);
  }

  function agregar(){
    datosArticulo = document.getElementById('pidarticulo').value.split('_');

    idarticulo = datosArticulo[0];
    articulo = $("#pidarticulo option:selected").text();
    cantidad = $("#pcantidad").val();
    descuento = $("#pdescuento").val();
    precio_venta = $("#pprecio_venta").val();
    stock = $("#pstock").val();

    console.log(descuento);

    if(idarticulo != "" && cantidad != "" && cantidad > 0 && descuento != "" && precio_venta != ""){

      if(stock >= cantidad){
        subtotal[cont] = (cantidad * (precio_venta - descuento));
        total = total + subtotal[cont];

        var fila = '<tr class = "selected" id = "fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick = "eliminar('+cont+');">Eliminar</button></td><td><input name="idarticulo[]" value="'+idarticulo+'" type="hidden">'+articulo+'</input></td><td><input name="cantidad[]" value="'+cantidad+'" type="number"></input></td><td><input name="precio_venta[]" value="'+precio_venta+'" type="number"></input></td><td><input name="descuento[]" value="'+descuento+'" type="number"></input></td><td>'+subtotal[cont]+'</td></tr>';

        cont++;
        limpiar();
        $("#total").html("$ " + total);
        $("#total_venta").val(total);
        evaluar();
        $("#detalles").append(fila);
      }else{
        alert("La cantidad supera el stock.");
      }
      
    }else{
      alert("Error al ingresar la venta. Revisa los datos.");
    }
  }

  function limpiar(){
    $("#pcantidad").val("");
    $("#pdescuento").val("");
    $("#pstock").val("");
    $("#pprecio_venta").val("");
  }

  function evaluar(){
    if(total > 0){
      $("#guardar").show();
    }else{
      $("#guardar").hide();
    }
  }

  function eliminar(index){
    total = total - subtotal[index];
    $("#total").html("$ " + total);
    $("#total_venta").val(total);
    $("#fila"+ index).remove();
    evaluar();
  }
</script>
@endpush
@endsection