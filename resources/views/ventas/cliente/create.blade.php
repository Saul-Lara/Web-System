@extends('layouts.admin')

@section('titulo', 'Nuevo Cliente')

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
        {!! Form::open(array('url' => 'ventas/cliente', 'method' => 'POST', 'autocomplete' => 'off')) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{old('nombre')}}" placeholder="Nombre..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" required value="{{old('direccion')}}" placeholder="Direccion del cliente..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" required value="{{old('telefono')}}" placeholder="Telefono del cliente..." class="form-control">
                      </div>

                  </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label>Documento</label>
                        <select name="tipo_documento" class="form-control">
                          <option value="DNI">DNI</option>
                          <option value="RUC">RUC</option>
                          <option value="PAS">PAS</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="num_documento">Num. Documento</label>
                        <input type="text" name="num_documento" required value="{{old('num_documento')}}" placeholder="Num. documento del cliente..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" placeholder="Email del cliente..." class="form-control">
                      </div>
                  </div>
                </div>
            </div>

            <div class="col-md-12">
              <div class="block">
                <div class="block-body">
                  <div class="form-group">       
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>

        

        
        {!! Form::close() !!}
@endsection