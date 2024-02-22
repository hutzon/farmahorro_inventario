<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
Route::resource('proveedores', App\Http\Controllers\ProveedoreController::class);
Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::resource('lotes', App\Http\Controllers\LoteController::class);
Route::resource('movimientos', App\Http\Controllers\MovimientoController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');