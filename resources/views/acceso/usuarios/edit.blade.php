@extends('layouts.admin')

@section('titulo', 'Editar Usuarios')

@section('contenido')
        <div class="row">
            <div class="col-lg-7">
                <div class="block">
                  
                  <div class="block-body">
                    {!! Form::model($usuario, ['method' => 'PATCH', 'route' => ['usuarios.update', $usuario->id]]) !!}
                    {{ Form::token() }}
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name }}" required autofocus>

                        @if ($errors->has('name'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                          </span>
                        @endif

                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email }}" required>

                        @if ($errors->has('email'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif

                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif

                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Confirmar Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

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