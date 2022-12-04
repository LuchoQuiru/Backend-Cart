<?php

use App\Http\Controllers\ProductosController;
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

Route::get('/tablaCategorias', '\App\Http\Controllers\CategoriasController@index')->middleware('auth');;
Route::get('/tablaCategorias/create', '\App\Http\Controllers\CategoriasController@create')->middleware(['auth', 'isAdmin']);
Route::get('/tablaCategorias/edit/{id_categoria}', '\App\Http\Controllers\CategoriasController@edit')->middleware(['auth', 'isAdmin']);;
Route::post('/tablaCategorias/destroy/{id_categoria}', '\App\Http\Controllers\CategoriasController@destroy')->middleware(['auth', 'isAdmin']);
Route::post('/tablaCategorias/store', '\App\Http\Controllers\CategoriasController@store')->middleware(['auth', 'isAdmin']);
Route::post('/tablaCategorias/update/{id_categoria}', '\App\Http\Controllers\CategoriasController@update')->middleware(['auth', 'isAdmin']);

Route::get('/tablaProductos', '\App\Http\Controllers\ProductosController@index')->middleware('auth');
Route::get('/tablaProductos/create', '\App\Http\Controllers\ProductosController@create')->middleware(['auth', 'isAdmin']);
Route::get('/tablaProductos/edit/{id_producto}', '\App\Http\Controllers\ProductosController@edit')->middleware(['auth', 'isAdmin']);
Route::get('/tablaProductos/categorias', '\App\Http\Controllers\ProductosController@getCategorias')->middleware(['auth', 'isAdmin']);
Route::post('/tablaProductos/update/{id_producto}', '\App\Http\Controllers\ProductosController@update')->middleware(['auth', 'isAdmin']);
Route::post('/tablaProductos/store', '\App\Http\Controllers\ProductosController@store')->middleware(['auth', 'isAdmin']);
Route::post('/tablaProductos/destroy/{id_producto}', '\App\Http\Controllers\ProductosController@destroy')->middleware(['auth', 'isAdmin']);

Route::get('/tablaUsuarios', '\App\Http\Controllers\TablasController@index')->middleware('auth');;
Route::get('/tablaUsuarios/create', '\App\Http\Controllers\TablasController@create')->middleware(['auth', 'isAdmin']);
Route::get('/tablaUsuarios/edit/{usuario}', '\App\Http\Controllers\TablasController@edit')->middleware(['auth', 'isAdmin']);;;
Route::post('/tablaUsuarios/update/{id_producto}', '\App\Http\Controllers\TablasController@update')->middleware(['auth', 'isAdmin']);
Route::post('/tablaUsuarios/destroy/{id_producto}', '\App\Http\Controllers\TablasController@destroy')->middleware(['auth', 'isAdmin']);
Route::post('/tablaUsuarios/store', '\App\Http\Controllers\TablasController@store')->middleware(['auth', 'isAdmin']);
Route::post('/tablaUsuarios/destroy', '\App\Http\Controllers\TablasController@destroy')->middleware(['auth', 'isAdmin']);


Route::get('/tablaPedidos', '\App\Http\Controllers\PedidosController@index')->middleware('auth');;
Route::get('/tablaPedidos/create', '\App\Http\Controllers\PedidosController@create')->middleware(['auth', 'isAdmin']);;
Route::get('/tablaPedidos/tabla_detalles_create_pedido', '\App\Http\Controllers\PedidosController@tabla_detalles_create_pedido')->middleware(['auth', 'isAdmin']);
Route::get('/tablaPedidos/tabla_detalles_edit_pedido/{id_pedido}', '\App\Http\Controllers\PedidosController@tabla_detalles_edit_pedido')->middleware(['auth']);
Route::get('/tablaPedidos/edit/{id_detalle}', '\App\Http\Controllers\PedidosController@edit')->middleware('auth');
Route::post('/tablaPedidos/store', '\App\Http\Controllers\PedidosController@store')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/update/{id_pedido}', '\App\Http\Controllers\PedidosController@update')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/agregarProductoAlNuevoPedido', '\App\Http\Controllers\PedidosController@agregarProductoALaSesionDeUnNuevoPedido')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/agregarProductoAlPedidoEdit/{id_pedido}', '\App\Http\Controllers\PedidosController@agregarProductoAlEditDelPedido')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/agregarUsuarioALaSesion', '\App\Http\Controllers\PedidosController@agregarUsuarioALaSesion')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/destroyDetalleCreateSession/{nombre_producto}', '\App\Http\Controllers\PedidosController@destroyDetalleCreateSession')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/destroyDetalleEditSession/{id_pedido}/{nombre_producto}', '\App\Http\Controllers\PedidosController@destroyDetalleEditSession')->middleware(['auth', 'isAdmin']);
Route::post('/tablaPedidos/destroy/{id_detalle}', '\App\Http\Controllers\PedidosController@destroy')->middleware(['auth', 'isAdmin']);



Route::post('/tablaDetalles', '\App\Http\Controllers\DetallesController@index')->middleware('auth');;
Route::get('/tablaDetalles/create', '\App\Http\Controllers\DetallesController@create')->middleware(['auth', 'isAdmin']);;
Route::get('/tablaDetalles/destroy/{id_detalle}', '\App\Http\Controllers\DetallesController@edit')->middleware(['auth', 'isAdmin']);;


Route::get('/tablaOfertas', '\App\Http\Controllers\OfertasController@index')->middleware('auth');;
Route::get('/tablaOfertas/create', '\App\Http\Controllers\OfertasController@create')->middleware(['auth', 'isAdmin']);;;
Route::get('/tablaOfertas/edit/{id_oferta}', '\App\Http\Controllers\OfertasController@edit')->middleware(['auth', 'isAdmin']);;
Route::post('/tablaOfertas/store', '\App\Http\Controllers\OfertasController@store')->middleware(['auth', 'isAdmin']);;;
Route::post('/tablaOfertas/update/{id_oferta}', '\App\Http\Controllers\OfertasController@update')->middleware(['auth', 'isAdmin']);;;;
Route::post('/tablaOfertas/destroy/{id_oferta}', '\App\Http\Controllers\OfertasController@destroy')->middleware(['auth', 'isAdmin']);;;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');


require __DIR__.'/auth.php';
