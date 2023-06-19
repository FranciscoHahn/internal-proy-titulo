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
Route::post('salir', 'App\Http\Controllers\Bienvenida@logout')->name('salir');
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
//
Route::get('agregarproducto', 'App\Http\Controllers\Bienvenida@agregarproducto')->name('agregarproducto');

