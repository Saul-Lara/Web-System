@extends('layouts.app')

@section('content')
<div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>AdVentas</h1>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form id="login-form" method="post" action="{{ route('login') }}">
                  @csrf
                    <div class="form-group">
                      <label class="label-material">Email Address</label>
                      <input id="email" type="email" name="email" required="" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" >
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="login-password" class="label-material">Password</label>
                      <input id="password" type="password" name="password" required="" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                      @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                    </div><button type="submit" class="btn btn-primary">Login</button>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form>
                  <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
