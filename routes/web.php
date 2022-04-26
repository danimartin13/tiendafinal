<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InicioController;
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

Route::get('/', [InicioController::class,'index'])->name('/');

Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');
//pagina categorias
Route::get('/categoria-{categoria}', [CategoriaController::class,'listarProductos'])->name('categoria');

//listar categoria
Route::get('/categorias', [CategoriaController::class, 'listar'])->name("listarCategorias");
//anadir categoria
Route::post('/nuevaCategoria', [CategoriaController::class, 'anadircategoria'])->name('anadircategoria');
//BORRAR CATEGOIRA
Route::delete('/eliminarCategoria{categoria}', [CategoriaController::class, 'eliminarcategoria'])->name('eliminarcategoria');

//actualizar categoria

Route::patch('/actcategoria-{categoria}', [CategoriaController::class, 'actcategoria'])->name('actcategoria');



// productos
// listar productos
Route::get('/productos', [ProductoController::class, 'listar'])->name("listarProductos");

//pagina productos
Route::get('/producto-{producto}', [ProductoController::class,'mostrarprod'])->name('producto');

//añadir producto
Route::post('/nuevaProducto', [ProductoController::class, 'anadirproducto'])->name('anadirproducto');
// eliminar producto eliminarprooducto
Route::delete('/eliminarprooducto{producto}', [ProductoController::class, 'eliminarprooducto'])->name('eliminarprooducto');
//actproducto
Route::patch('/actproducto-{producto}', [ProductoController::class, 'actproducto'])->name('actproducto');

//editar perfil
Route::get('/editarperfil', [InicioController::class, 'perfil'])->name('editarperfil');
Route::patch('/editarperfil-{usuario}', [InicioController::class, 'editarperfil'])->name('editarperfilActualizar');

// subircarrito
Route::post('/subircarrito-{producto}', [InicioController::class, 'subircarrito'])->name('subircarrito');
//carrito
Route::get('/carrito', [InicioController::class,'carrito'])->name('carrito');
//eliminarproductocarrito
Route::delete('/eliminarproductocarrito{producto}', [InicioController::class, 'eliminarproductocarrito'])->name('eliminarproductocarrito');

//comprarproducto
Route::patch('/comprarproducto-{usuario}', [InicioController::class, 'comprarproducto'])->name('comprarproducto');

//ventas
Route::get('/ventas', [InicioController::class, 'ventas'])->name('ventas');
