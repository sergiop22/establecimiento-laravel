<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//listado de API
Route::get('/establecimientos', 'ApiController@index')->name('establecimientos.index');
Route::get('/establecimientos/{establecimiento}', 'ApiController@show')->name('establecimientos.show');

Route::get('/categorias', 'ApiController@categorias')->name('categorias');
Route::get('/categorias/{categoria}', 'ApiController@categoria')->name('categoria');
