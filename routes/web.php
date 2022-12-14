<?php

use Illuminate\Support\Facades\Auth;
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

//Rutas de usuarios
Route::get('plataforma/usuarios',[\App\Http\Controllers\HomeController::class, 'empleados'])->name('plataforma.usuarios.index');
Route::get('plataforma/usuarios/habilitaciones',[\App\Http\Controllers\HomeController::class, 'habilitaciones'])->name('plataforma.usuarios.habilitaciones');
Route::get('plataforma/usuarios/{usuario}/edit', [\App\Http\Controllers\HomeController::class, 'edit'])->name('plataforma.usuarios.edit');
Route::get('plataforma/usuarios/{usuario}', [\App\Http\Controllers\HomeController::class, 'show'] )->name('plataforma.usuarios.show');
Route::match(['put', 'patch'],'plataforma/usuarios/{usuario}', [\App\Http\Controllers\HomeController::class, 'update'])->name('plataforma.usuarios.update');
Route::match(['put', 'patch'],'plataforma/usuarios/habilitar/{usuario}', [\App\Http\Controllers\HomeController::class, 'habilitar'])->name('plataforma.usuarios.habilitar');
Route::match(['put', 'patch'],'plataforma/usuarios/deshabilitar/{usuario}', [\App\Http\Controllers\HomeController::class, 'deshabilitar'])->name('plataforma.usuarios.deshabilitar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/plataforma', [App\Http\Controllers\HomeController::class, 'index'])->name('plataforma');

//Rutas de Productos
Route::get('plataforma/productos',[\App\Http\Controllers\ProductoController::class, 'index'])->name('plataforma.productos.index');
Route::get('plataforma/productos/create', [\App\Http\Controllers\ProductoController::class, 'create'])->name('plataforma.productos.create');
Route::post('plataforma/productos', [\App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store');
Route::get('plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'show'] )->name('plataforma.productos.show');
Route::get('plataforma/productos/{producto}/edit', [\App\Http\Controllers\ProductoController::class, 'edit'])->name('plataforma.productos.edit');
Route::match(['put', 'patch'],'plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'update'])->name('plataforma.productos.update');
Route::delete('plataforma/productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'destroy'])->name('plataforma.productos.destroy');
Route::match(['put', 'patch'],'plataforma/productos/habilitar/{producto}', [\App\Http\Controllers\ProductoController::class, 'habilitar'])->name('plataforma.productos.habilitar');
Route::match(['put', 'patch'],'plataforma/productos/deshabilitar/{producto}', [\App\Http\Controllers\ProductoController::class, 'deshabilitar'])->name('plataforma.productos.deshabilitar');



//Rutas de promociones
Route::get('plataforma/promociones',[\App\Http\Controllers\PromocionController::class, 'index'])->name('plataforma.promociones.index');
Route::get('plataforma/promociones/deshabilitados',[\App\Http\Controllers\PromocionController::class, 'deshabilitados'])->name('plataforma.promociones.deshabilitados');
Route::get('plataforma/promociones/create', [\App\Http\Controllers\PromocionController::class, 'create'])->name('plataforma.promociones.create');
Route::post('plataforma/promociones', [\App\Http\Controllers\PromocionController::class, 'store'])->name('promociones.store');
Route::get('plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'show'] )->name('plataforma.promociones.show');
Route::get('plataforma/promociones/{promocion}/edit', [\App\Http\Controllers\PromocionController::class, 'edit'])->name('plataforma.promociones.edit');
Route::match(['put', 'patch'],'plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'update'])->name('plataforma.promociones.update');
Route::delete('plataforma/promociones/{promocion}', [\App\Http\Controllers\PromocionController::class, 'destroy'])->name('plataforma.promociones.destroy');
Route::match(['put', 'patch'],'plataforma/promociones/habilitar/{promocion}', [\App\Http\Controllers\PromocionController::class, 'habilitar'])->name('plataforma.promociones.habilitar');
Route::match(['put', 'patch'],'plataforma/promociones/deshabilitar/{promocion}', [\App\Http\Controllers\PromocionController::class, 'deshabilitar'])->name('plataforma.promociones.deshabilitar');




//Rutas de ventas
Route::get('plataforma/ventasL',[\App\Http\Controllers\VentaController::class, 'index'])->name('plataforma.ventas.index');
Route::get('plataforma/ventas/rechazados',[\App\Http\Controllers\VentaController::class, 'rechazados'])->name('plataforma.ventas.rechazados');
Route::get('plataforma/ventasTomar',[\App\Http\Controllers\VentaController::class, 'tomaPedidos'])->name('plataforma.ventas.tomaPedidos');
Route::get('plataforma/ventasO',[\App\Http\Controllers\VentaController::class, 'indexOnline'])->name('plataforma.ventas.indexOnline');
Route::get('plataforma/ventasL/create/{venta}', [\App\Http\Controllers\VentaController::class, 'create'])->name('plataforma.ventas.create');
Route::post('ventas/anular/{venta}', [\App\Http\Controllers\VentaController::class, 'anular'])->name('ventas.anular');
Route::post('plataforma/ventas', [\App\Http\Controllers\VentaController::class, 'store'])->name('ventas.store');
Route::get('plataforma/ventas/{venta}', [\App\Http\Controllers\VentaController::class, 'show'] )->name('plataforma.ventas.show');
Route::get('plataforma/ventas/{venta}/edit', [\App\Http\Controllers\VentaController::class, 'edit'])->name('plataforma.ventas.edit');
Route::match(['put', 'patch'],'plataforma/ventaAnular/{venta}', [\App\Http\Controllers\VentaController::class, 'anular'])->name('plataforma.ventas.anular');
Route::match(['put', 'patch'],'plataforma/ventaTomar/{venta}', [\App\Http\Controllers\VentaController::class, 'tomar'])->name('plataforma.ventas.tomarPedido');
Route::match(['put', 'patch'],'plataforma/ventas/guardar/{venta}', [\App\Http\Controllers\VentaController::class, 'guardar'])->name('plataforma.ventas.guardar');
Route::post('plataforma/ventas/insertar', [\App\Http\Controllers\VentaController::class, 'insertarPromo'])->name('ventas.insertar.store');
Route::delete('plataforma/ventas/ep/{promo_venta}', [\App\Http\Controllers\VentaController::class, 'eliminarP'])->name('plataforma.ventas.eliminarP');
Route::delete('plataforma/ventas/{venta}', [\App\Http\Controllers\VentaController::class, 'destroy'])->name('plataforma.ventas.destroy');
Route::get('boletaV/{venta}', [\App\Http\Controllers\VentaController::class, 'boleta'])->name('plataforma.ventas.boleta');
Route::get('plataforma/ventaLocal',[\App\Http\Controllers\VentaController::class, 'ventaLocal'])->name('plataforma.ventas.ventaLocal');
Route::post('plataforma/ventas/reporteMensual', [\App\Http\Controllers\VentaController::class, 'reporteMensual'])->name('ventas.reporteMensual');
Route::post('plataforma/ventas/reporteDiario', [\App\Http\Controllers\VentaController::class, 'reporteDiario'])->name('ventas.reporteDiario');

//Rutas de comandas
Route::get('plataforma/comandas',[\App\Http\Controllers\ComandaController::class, 'index'])->name('plataforma.comandas.index');
Route::get('plataforma/comandas/toma',[\App\Http\Controllers\ComandaController::class, 'tomar'])->name('plataforma.comandas.tomar');
Route::get('plataforma/comandas/create', [\App\Http\Controllers\ComandaController::class, 'create'])->name('plataforma.comandas.create');
Route::post('plataforma/comandas', [\App\Http\Controllers\ComandaController::class, 'store'])->name('comandas.store');
Route::get('plataforma/comandas/{comanda}', [\App\Http\Controllers\ComandaController::class, 'show'] )->name('plataforma.comandas.show');
Route::match(['put', 'patch'],'plataforma/comandas/{comanda}', [\App\Http\Controllers\ComandaController::class, 'update'])->name('plataforma.comandas.finalizar');
Route::match(['put', 'patch'],'plataforma/comandas/rechazar/{comanda}', [\App\Http\Controllers\ComandaController::class, 'rechazar'])->name('plataforma.comandas.rechazar');

//Rutas de repartos
Route::get('plataforma/repartos',[\App\Http\Controllers\RepartoController::class, 'index'])->name('plataforma.repartos.index');
Route::get('plataforma/repartos/create', [\App\Http\Controllers\RepartoController::class, 'create'])->name('plataforma.repartos.create');
Route::post('plataforma/repartos', [\App\Http\Controllers\RepartoController::class, 'store'])->name('repartos.store');
Route::get('plataforma/repartos/{reparto}', [\App\Http\Controllers\RepartoController::class, 'show'] )->name('plataforma.repartos.show');
Route::get('plataforma/repartos/{reparto}/tomar', [\App\Http\Controllers\RepartoController::class, 'tomar'])->name('plataforma.repartos.tomar');
Route::match(['put', 'patch'],'plataforma/repartos/{reparto}', [\App\Http\Controllers\RepartoController::class, 'update'])->name('plataforma.repartos.update');
Route::delete('plataforma/repartos/{reparto}', [\App\Http\Controllers\RepartoController::class, 'destroy'])->name('plataforma.repartos.destroy');
Route::match(['put', 'patch'],'plataforma/repartos/{reparto}', [\App\Http\Controllers\RepartoController::class, 'finalizar'])->name('plataforma.repartos.finalizar');

//Rutas del carrito de ventas
Route::post('plataforma/promociones/{promocion}/carrito', [\App\Http\Controllers\PromocionCarritoController::class, 'store'])->name('promociones.carritos.store');
Route::delete('plataforma/promociones/{promocion}/carrito/{carrito}', [\App\Http\Controllers\PromocionCarritoController::class, 'destroy'])->name('promociones.carritos.destroy');
Route::get('carrito',[\App\Http\Controllers\CarritoController::class, 'index'])->name('carritos.index');
Route::get('ventas/create', [\App\Http\Controllers\VentaController::class, 'createO'])->name('ventasO.create');
Route::post('ventas/', [\App\Http\Controllers\VentaController::class, 'storeO'])->name('ventasO.store');
Route::post('ventas/anular', [\App\Http\Controllers\VentaController::class, 'anular'])->name('ventas.anular');
Route::get('ventas/webpay/{venta}', [\App\Http\Controllers\VentaController::class, 'webpay'])->name('ventasO.webpay');
Route::get('ventas/confirmacion/{venta}', [\App\Http\Controllers\VentaController::class, 'confirmacion'])->name('ventasO.confirmacion');
Route::get('ventas/seguimiento/{venta}', [\App\Http\Controllers\VentaController::class, 'seguimiento'])->name('ventas.seguimiento');

//Rutas de los ingredientes (Productos y Promoci??n)
Route::get('plataforma/ingredientes',[\App\Http\Controllers\ProductoPromocionController::class, 'index'])->name('plataforma.ingredientes.index');
Route::get('plataforma/ingredientes/create/{promocion}', [\App\Http\Controllers\ProductoPromocionController::class, 'create'])->name('plataforma.ingredientes.create');
Route::post('plataforma/ingredientes/{promocion}/producto', [\App\Http\Controllers\ProductoPromocionController::class, 'store'])->name('ingredientes.store');
Route::get('plataforma/ingredientes/{promocion}', [\App\Http\Controllers\ProductoPromocionController::class, 'show'] )->name('plataforma.ingredientes.show');
Route::delete('plataforma/ingredientes/{promocion}/producto/{producto}', [\App\Http\Controllers\ProductoPromocionController::class, 'destroy'])->name('plataforma.ingredientes.destroy');
