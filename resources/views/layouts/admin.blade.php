<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdVentas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('css/font.css')}}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/style.blue.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header"><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Ad</strong><strong>Ventas</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">AD</strong><strong>V</strong></div></a>
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <ul class="right-menu list-inline no-margin-bottom">
            <li class="list-inline-item logout"><a id="logout" href="{{route('logout')}}" class="nav-link">Logout <i class="icon-logout"></i></a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('img/avatar.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{Auth::user()->name}}</h1>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <span class="heading">Menu</span>

        <ul class="list-unstyled">

          <li><a href="#Almacen" aria-expanded="false" data-toggle="collapse"> <i class="icon-computer"></i>Almacen </a>
            <ul id="Almacen" class="collapse list-unstyled ">
              <li><a href="{{ url('almacen/articulo') }}">Articulos</a></li>
              <li><a href="{{ url('almacen/categoria') }}">Categorias</a></li>
            </ul>
          </li>

          <li><a href="#Compras" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Compras </a>
            <ul id="Compras" class="collapse list-unstyled ">
              <li><a href="{{ url('compras/ingreso') }}">Ingresos</a></li>
              <li><a href="{{ url('compras/proveedor') }}">Proveedores</a></li>
            </ul>
          </li>

          <li><a href="#Ventas" aria-expanded="false" data-toggle="collapse"> <i class="icon-bill"></i>Ventas </a>
            <ul id="Ventas" class="collapse list-unstyled ">
              <li><a href="{{ url('ventas/ventas') }}">Ventas</a></li>
              <li><a href="{{ url('ventas/cliente') }}">Clientes</a></li>
            </ul>
          </li>

          <li><a href="#Acceso" aria-expanded="false" data-toggle="collapse"> <i class="icon-user-outline"></i>Acceso </a>
            <ul id="Acceso" class="collapse list-unstyled ">
              <li><a href="{{ url('acceso/usuarios') }}">Usuarios</a></li>
            </ul>
          </li>

          <li><a href="#"> <i class="icon-page"></i>Ayuda </a></li>

          <li><a href="#"> <i class="icon-page"></i>Acerca de... </a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Sistema de ventas</h2>
          </div>
        </div>

        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="categoria">Home</a></li>
            <li class="breadcrumb-item active">@yield('titulo')</li>
          </ul>
        </div>

        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title">
                    <strong>@yield('titulo')</strong>
                  </div>
                  
                  <div class="block-body">
                    @yield('contenido')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">Copyright &copy; 2015-2020 <a href="https://saul-lara.github.io/">Saul Lara</a>.</strong> All rights reserved.</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"> </script>
    <script src="{{asset('js/front.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
  </body>
</html>