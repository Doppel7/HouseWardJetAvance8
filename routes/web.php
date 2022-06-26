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

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dash', function () {
    return view('dash.index');
})->name('dash');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create')->middleware('auth');;
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store')->middleware('auth');;
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('auth');;
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show')->middleware('auth');;
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('auth');;
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('auth');;
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete')->middleware('auth');;
Route::get('compras/{compra}/pdf',  [App\Http\Controllers\CompraController::class, 'pdf'])->name('compras.pdf')->middleware('auth');
Route::delete('/compras/{id}', [App\Http\Controllers\CompraController::class, 'destroy'])->name('compras.delete')->middleware('auth');;
Route::resource('compras',  App\Http\Controllers\CompraController::class)->middleware('auth');
Route::get('fichatecnicas/{fichatecnica}/pdf',  [App\Http\Controllers\FichatecnicaController::class, 'pdf'])->name('fichatecnicas.pdf')->middleware('auth');
Route::resource('fichatecnicas',  App\Http\Controllers\FichatecnicaController::class)->middleware('auth');
Route::get('pedidos/{pedido}/pdf',  [App\Http\Controllers\PedidoController::class, 'pdf'])->name('pedidos.pdf')->middleware('auth');
Route::resource('pedidos',  App\Http\Controllers\PedidoController::class)->middleware('auth');
/* Route::resource('home',  App\Http\Controllers\HomeController::class)->middleware('auth');  */
Route::get('home', ['as' => 'home.index', 'uses' => 'App\Http\Controllers\HomeController@index'])->middleware('auth');


//Route Hooks - Do not delete//
	Route::view('unidades', 'livewire.unidades.index')->middleware('auth');
	Route::view('productos', 'livewire.productos.index')->middleware('auth');
	Route::view('roles', 'livewire.roles.index')->middleware('auth');
	Route::view('municipios', 'livewire.municipios.index')->middleware('auth');
	Route::view('usuarios', 'livewire.usuarios.index')->middleware('auth');
	Route::view('categoriaproductos', 'livewire.categoriaproductos.index')->middleware('auth');
	Route::view('empleados', 'livewire.empleados.index')->middleware('auth');
	Route::view('tipodocumento', 'livewire.tipodocumento.index')->middleware('auth');
	Route::view('proveedores', 'livewire.proveedores.index')->middleware('auth');
	Route::view('insumos', 'livewire.insumos.index')->middleware('auth');
	Route::view('categoriaproveedores', 'livewire.categoriaproveedores.index')->middleware('auth');
	Route::view('categoriainsumos', 'livewire.categoriainsumos.index')->middleware('auth');
