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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empleado', 'App\Http\Controllers\EmpleadoController@index');

Route::put('/empleado/actualizar', 'App\Http\Controllers\EmpleadoController@actualizar');

Route::post('/empleado/guardar', 'App\Http\Controllers\EmpleadoController@guardar');

Route::delete('/empleado/borrar/{id}', 'App\Http\Controllers\EmpleadoController@destruir');

Route::get('/empleado/buscar', 'App\Http\Controllers\EmpleadoController@mostrar');

Route::get('/empleado/obtenerDropdown', 'App\Http\Controllers\EmpleadoController@obtenerDropdown')->name('obtenerDropdown');

Route::get('/marcacion', 'App\Http\Controllers\MarcacionController@index');

Route::put('/marcacion/actualizar', 'App\Http\Controllers\MarcacionController@actualizar');

Route::post('/marcacion/guardar', 'App\Http\Controllers\MarcacionController@guardar');

Route::delete('/marcacion/borrar/{id}', 'App\Http\Controllers\MarcacionController@destruir');

Route::get('/marcacion/buscar', 'App\Http\Controllers\MarcacionController@mostrar');

Route::get('/marcacion/obtenerFechas', 'App\Http\Controllers\MarcacionController@obtenerFechas');