<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'App\Http\Controllers\Bienvenida@inicio')->name('/');
Route::post('ingresar', 'App\Http\Controllers\Bienvenida@login')->name('ingresar');
//logout
Route::get('salir', 'App\Http\Controllers\Bienvenida@logout')->name('salir');
Route::get('inicio', 'App\Http\Controllers\Bienvenida@inicio')->name('inicio');
Route::get('inicio-admin', 'App\Http\Controllers\Bienvenida@is_admin')->name('inicio-admin');
Route::get('usuarios', 'App\Http\Controllers\Bienvenida@adminusuarios')->name('usuarios');
Route::get('crearusuario', 'App\Http\Controllers\Bienvenida@crearusuario')->name('crearusuario');
Route::post('registrousuario', 'App\Http\Controllers\Bienvenida@registrousuario')->name('registrousuario');
Route::get('activarusuario/{id}', 'App\Http\Controllers\Bienvenida@activarusuario')->name('activarusuario');
Route::get('desactivarusuario/{id}', 'App\Http\Controllers\Bienvenida@desactivarusuario')->name('desactivarusuario');
Route::get('editarusuario/{id}', 'App\Http\Controllers\Bienvenida@editarusuario')->name('editarusuario');
Route::post('edicionusuario', 'App\Http\Controllers\Bienvenida@edicionusuario')->name('edicionusuario');
Route::get('productos', 'App\Http\Controllers\Bienvenida@productos')->name('productos');
Route::get('inicio-bodega', 'App\Http\Controllers\Bienvenida@is_bodega');
Route::get('inicio-cocina', 'App\Http\Controllers\Bienvenida@is_cocina');
Route::get('inicio-mesero', 'App\Http\Controllers\Bienvenida@is_mesero');

Route::post('registroproducto', 'App\Http\Controllers\Bienvenida@registroproducto')->name('registroproducto');
//editarproducto
Route::get('editarproducto/{id}', 'App\Http\Controllers\Bienvenida@editarproducto')->name('editarproducto');
Route::post('edicionproducto', 'App\Http\Controllers\Bienvenida@edicionproducto')->name('edicionproducto');

Route::get('activarproducto/{id}', 'App\Http\Controllers\Bienvenida@activarproducto')->name('activarproducto');
Route::get('desactivarproducto/{id}', 'App\Http\Controllers\Bienvenida@desactivarproducto')->name('desactivarproducto');

//
Route::get('agregarproducto', 'App\Http\Controllers\Bienvenida@agregarproducto')->name('agregarproducto');


Route::get('clientes', 'App\Http\Controllers\Clientes@adminclientes')->name('clientes');
Route::get('activarcliente/{id}', 'App\Http\Controllers\Clientes@activarcliente')->name('activarcliente');
Route::get('desactivarcliente/{id}', 'App\Http\Controllers\Clientes@desactivarcliente')->name('desactivarcliente');

Route::get('preparaciones', 'App\Http\Controllers\Preparaciones@adminpreparaciones')->name('preparaciones');
Route::get('agregarpreparacion', 'App\Http\Controllers\Preparaciones@agregarpreparacion')->name('agregarpreparacion');
Route::post('agregandopreparacion', 'App\Http\Controllers\Preparaciones@agregandopreparacion')->name('agregandopreparacion');
Route::get('editarpreparacion/{id}', 'App\Http\Controllers\Preparaciones@editarpreparacion')->name('editarpreparacion');
Route::post('editandopreparacion', 'App\Http\Controllers\Preparaciones@editandopreparacion')->name('editandopreparacion');
Route::get('admincompras', 'App\Http\Controllers\Inventario@admincompras')->name('compras');
//agregarcompra
Route::get('agregarcompra', 'App\Http\Controllers\Inventario@agregarcompra')->name('agregarcompra');
Route::post('agregandocompra', 'App\Http\Controllers\Inventario@agregandocompra')->name('agregandocompra');
Route::get('eliminardetallecompra/{id}', 'App\Http\Controllers\Inventario@eliminardetallecompra')->name('eliminardetallecompra');
Route::get('salidasinventario', 'App\Http\Controllers\Inventario@salidasinventario')->name('salidasinventario');
Route::get('registrarsalidainventario', 'App\Http\Controllers\Inventario@registrarsalidainventario')->name('registrarsalidainventario');
//creandosalidasdeinventario
Route::post('creandosalidasdeinventario', 'App\Http\Controllers\Inventario@creandosalidasdeinventario')->name('creandosalidasdeinventario');
Route::get('eliminarsalidainventario/{id}', 'App\Http\Controllers\Inventario@eliminarsalidainventario')->name('eliminarsalidainventario');
//mesas
Route::get('mesas', 'App\Http\Controllers\Mesas@mesas')->name('iniciomesas');
Route::get('iniciaratencion/{idmesa}', 'App\Http\Controllers\Mesas@iniciaratencion')->name('iniciaratencion');
//veratencion
Route::get('veratencion/{idmesa}', 'App\Http\Controllers\Mesas@veratencion')->name('veratencion');

//desactivarpreparacion
//activarpreparacion
Route::get('desactivarpreparacion/{id}', 'App\Http\Controllers\Preparaciones@desactivarpreparacion')->name('desactivarpreparacion');
Route::get('activarpreparacion/{id}', 'App\Http\Controllers\Preparaciones@activarpreparacion')->name('activarpreparacion');
Route::get('agregarpedidos/{id}', 'App\Http\Controllers\Mesas@agregarpedidos')->name('agregarpedidos');
Route::post('agregarpedidosatencion', 'App\Http\Controllers\Mesas@agregarpedidosatencion')->name('agregarpedidosatencion');

//cocinainicio
//atencionescocina


Route::get('pedidoscocina', 'App\Http\Controllers\Cocina@pedidoscocina')->name('pedidoscocina');
Route::post('pedidodisponiblecocina', 'App\Http\Controllers\Cocina@pedidodisponiblecocina')->name('pedidodisponiblecocina');
Route::post('pedidoentregadomesa', 'App\Http\Controllers\Mesas@pedidoentregadomesa')->name('pedidoentregadomesa');
//cancelarpedidomesero
Route::post('cancelarpedidomesero', 'App\Http\Controllers\Mesas@cancelarpedidomesero')->name('cancelarpedidomesero');
//solicitarpagomesero
Route::get('solicitarpagomesero/{idatencion}/{idmesa}', 'App\Http\Controllers\Mesas@solicitarpagomesero')->name('solicitarpagomesero');