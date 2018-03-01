@extends('layouts.admin')

@section('titulo', 'Editar Categoria')

@section('contenido')
        <div class="row">
            <div class="col-lg-7">
                <div class="block">
                  
                  <div class="block-body">
                    {!! Form::model($categoria, ['method' => 'PATCH', 'route' => ['categoria.update', $categoria->idcategoria]]) !!}
                    {{ Form::token() }}
                      <div class="form-group">
                        <label class="nombre">Nombre</label>
                        <input type="text" name="nombre" value="{{$categoria->nombre}}" placeholder="Nombre de la categoria" class="form-control">
                      </div>
                      <div class="form-group">       
                        <label class="descripcion">Descripcion</label>
                        <input type="text" name="descripcion" value="{{$categoria->descripcion}}" placeholder="Descripcion" class="form-control">
                      </div>
                      <div class="form-group">       
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                      </div>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>

            <div class="col-lg-5">
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
@endsection