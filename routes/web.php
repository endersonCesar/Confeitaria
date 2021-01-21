<?php

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

Route::get('/', function () { return view('welcome');});
Route::resource('torta', 'Pedidos\TortaController', ['except' => ['show','edit']]);

Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::resource('confirmacao', 'ConfirmacaoPedido\ConfirmacaoPedidoController', ['except' => ['show','edit']]);
	Route::resource('fidelidade', 'Fidelidade\FidelidadeController', ['except' => ['show','edit']]);
	Route::resource('usuario', 'Usuario\UsuarioController', ['except' => ['show','edit']]);


	Route::get('confirmacao/imprimir/{id}', 'ConfirmacaoPedido\ConfirmacaoPedidoController@imprimir')->name('confirmacao.imprimir');


	Route::post('fidelidade/buscaNome', 'Fidelidade\FidelidadeController@buscaNome');
	Route::post('fidelidade/buscaCpf', 'Fidelidade\FidelidadeController@buscaCpf');
	Route::post('usuario/buscarNome', 'Usuario\UsuarioController@buscarNome');

});
Route::get('/home', 'HomeController@index')->name('home');
