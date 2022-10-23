<?php

use App\Http\Controllers\Api\SubirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ficheros', 'App\Http\Controllers\FicheroController@index');//Mostrar ficheros
Route::post('/ficheros', 'App\Http\Controllers\FicheroController@store');//Crear Fichero
Route::delete('/ficheros/{fichero}', 'App\Http\Controllers\FicheroController@destroy');//Eliminar fichero
Route::post('/ficherosmulti', 'App\Http\Controllers\FicheroController@multi');//Agregar Multi archivos

