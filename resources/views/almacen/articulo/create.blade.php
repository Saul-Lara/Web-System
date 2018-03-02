@extends('layouts.admin')

@section('titulo', 'Nuevo Articulo')

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
        {!! Form::open(array('url' => 'almacen/articulo', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true')) !!}
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
                        <label for="codigo">Codigo</label>
                        <input type="text" name="codigo" required value="{{old('codigo')}}" placeholder="Codigo del articulo..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                      </div>

                  </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label>Categoria</label>
                        <select name="idcategoria" class="form-control">
                        @foreach($categorias as $cat)
                          <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                        @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="number" name="stock" value="{{old('stock')}}"  min="0" placeholder="Stock del articulo..." class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" name="descripcion" value="{{old('descripcion')}}" placeholder="Descripcion del articulo..." class="form-control">
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