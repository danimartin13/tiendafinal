<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//listar categoria
Route::get('/categorias', [CategoriaController::class, 'listar'])->name("listarCategorias");
//anadir categoria
Route::post('/nuevaCategoria', [CategoriaController::class, 'anadircategoria'])->name('anadircategoria');
//BORRAR CATEGOIRA
Route::delete('/eliminarCategoria{categoria}', [CategoriaController::class, 'eliminarcategoria'])->name('eliminarcategoria');

//actualizar categoria

Route::patch('/actcategoria-{categoria}', [CategoriaController::class, 'actcategoria'])->name('actcategoria');
