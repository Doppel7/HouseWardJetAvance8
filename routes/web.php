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

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
Route::get('compras/{compra}/pdf',  [App\Http\Controllers\CompraController::class, 'pdf'])->name('compras.pdf')->middleware('auth');
Route::delete('/compras/{id}', [App\Http\Controllers\CompraController::class, 'destroy'])->name('compras.delete');
Route::resource('compras',  App\Http\Controllers\CompraController::class)->middleware('auth');
Route::get('fichatecnicas/{fichatecnica}/pdf',  [App\Http\Controllers\FichatecnicaController::class, 'pdf'])->name('fichatecnicas.pdf')->middleware('auth');
Route::resource('fichatecnicas',  App\Http\Controllers\FichatecnicaController::class)->middleware('auth');
Route::get('pedidos/{pedido}/pdf',  [App\Http\Controllers\PedidoController::class, 'pdf'])->name('pedidos.pdf')->middleware('auth');
Route::resource('pedidos',  App\Http\Controllers\PedidoController::class)->middleware('auth');

//Route Hooks - Do not delete//
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
