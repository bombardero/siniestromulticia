<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\City;
use App\Models\Modelo;

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


Route::get('/provincias/{id}/localidades',function(Request $request,$id){
    return City::where('province_id',$id)->orderBy('name')->get();
})->name('localidades.index');

Route::get('/marcas/{id}/modelos',function(Request $request,$id){
    return Modelo::where('marca_id',$id)->orderBy('nombre')->get();
})->name('modelos.index');
