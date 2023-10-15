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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\GastoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//TAG
Route::get('/tag/get/{id}', [ProductoController::class, 'tagGet']);
Route::post('/tag/create', [ProductoController::class, 'tagCreate']);
Route::put('/tag/update/{id}', [ProductoController::class, 'tagUpdate']);
Route::delete('/tag/delete/{id}', [ProductoController::class, 'tagDelete']);

//PRODUCTOS
Route::get('/producto/get/{id}', [ProductoController::class, 'productoGet']);
Route::post('/producto/create', [ProductoController::class, 'productoCreate']);
Route::put('/producto/update/{id}', [ProductoController::class, 'productoUpdate']);
Route::delete('/producto/delete/{id}', [ProductoController::class, 'productoDelete']);

//VENTAS
Route::get('/venta/get/{id}', [VentaController::class, 'ventaGet']);
Route::post('/venta/create', [VentaController::class, 'ventaCreate']);
Route::put('/venta/update/{id}', [VentaController::class, 'ventaUpdate']);
Route::delete('/venta/delete/{id}', [VentaController::class, 'ventaDelete']);

//TIPO GASTOS
Route::get('/tipogasto/get/{id}', [GastoController::class, 'tipogastoGet']);
Route::post('/tipogasto/create', [GastoController::class, 'tipogastoCreate']);
Route::put('/tipogasto/update/{id}', [GastoController::class, 'tipogastoUpdate']);
Route::delete('/tipogasto/delete/{id}', [GastoController::class, 'tipogastoDelete']);

//GASTOS
Route::get('/gasto/get/{id}', [GastoController::class, 'gastoGet']);
Route::post('/gasto/create', [GastoController::class, 'gastoCreate']);
Route::put('/gasto/update/{id}', [GastoController::class, 'gastoUpdate']);
Route::delete('/gasto/delete/{id}', [GastoController::class, 'gastoDelete']);