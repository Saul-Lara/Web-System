@extends('layouts.admin')

@section('titulo', 'Editar Proveedor')

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
        
        {!! Form::model($persona, ['method' => 'PATCH', 'route' => ['proveedor.update', $persona->idpersona]]) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{$persona->nombre}}" placeholder="Nombre..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" required value="{{$persona->direccion}}" placeholder="Direccion del cliente..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" required value="{{$persona->telefono}}" placeholder="Telefono del cliente..." class="form-control">
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
                        @if($persona->tipo_documento == 'DNI')
                          <option value="DNI" selected>DNI</option>
                          <option value="RUC">RUC</option>
                          <option value="PAS">PAS</option>
                        @elseif($persona->tipo_documento == 'RUC')
                          <option value="DNI">DNI</option>
                          <option value="RUC" selected>RUC</option>
                          <option value="PAS">PAS</option>
                        @else
                          <option value="DNI">DNI</option>
                          <option value="RUC">RUC</option>
                          <option value="PAS" selected>PAS</option>
                        @endif
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="num_documento">Num. Documento</label>
                        <input type="text" name="num_documento" required value="{{$persona->num_documento}}" placeholder="Num. documento del cliente..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{$persona->email}}" placeholder="Email del cliente..." class="form-control">
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