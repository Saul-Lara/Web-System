@extends('layouts.admin')

@section('titulo', 'Editar Articulo')

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
        
        {!! Form::model($articulo, ['method' => 'PATCH', 'route' => ['articulo.update', $articulo->idarticulo], 'files' => 'true']) !!}
        {{ Form::token() }}
        <div class="row">
            <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="codigo">Codigo</label>
                        <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                        @if(($articulo->imagen != "" ))
                          <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px" class="img-thumbnail">
                        @endif
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
                          @if($cat->idcategoria == $articulo->idcategoria)
                          <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                          @else
                          <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                          @endif
                        @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="number" name="stock" value="{{$articulo->stock}}"  min="0" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" name="descripcion" value="{{$articulo->descripcion}}" placeholder="Descripcion del articulo..." class="form-control">
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