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


Route::get('/', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plataforma', function () {
    return view('plataforma.inicio');
})->name('plataforma');

Route::get('plataforma/productos',[\App\Http\Controllers\ProductoController::class, 'index'])->name('plataforma.productos.index');
Route::get('plataforma/productos/create', [\App\Http\Controllers\ProductoController::class, 'create'])->name('plataforma.productos.create');
Route::post('plataforma/productos', [\App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
Route::get('plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'show'] )->name('plataforma.productos.show');
Route::get('plataforma/productos/{producto}/edit', [\App\Http\Controllers\ProductoController::class, 'edit'])->name('plataforma.productos.edit');
Route::match(['put', 'patch'],'plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'update'])->name('plataforma.productos.update');
Route::delete('plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'destroy'])->name('plataforma.productos.destroy');

Route::get('plataforma/promociones',[\App\Http\Controllers\PromocionController::class, 'index'])->name('plataforma.promociones.index');
Route::get('plataforma/promociones/create', [\App\Http\Controllers\PromocionController::class, 'create'])->name('plataforma.promociones.create');
Route::post('plataforma/promociones', [\App\Http\Controllers\PromocionController::class, 'store'])->name('promociones.store');
Route::get('plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'show'] )->name('plataforma.promociones.show');
Route::get('plataforma/promociones/{promocion}/edit', [\App\Http\Controllers\PromocionController::class, 'edit'])->name('plataforma.promociones.edit');
Route::match(['put', 'patch'],'plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'update'])->name('plataforma.promociones.update');
Route::delete('plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'destroy'])->name('plataforma.promociones.destroy');
