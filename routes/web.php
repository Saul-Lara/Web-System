<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('almacen/categoria', 'CategoriaController'); //Se declara una ruta de recursos

Route::resource('almacen/articulo', 'ArticuloController'); //Se declara una ruta de recursos

Route::resource('ventas/cliente', 'ClienteController'); //Se declara una ruta de recursos

Route::resource('compras/proveedor', 'ProveedorController'); //Se declara una ruta de recursos

Route::resource('compras/ingreso', 'IngresoController'); //Se declara una ruta de recursos