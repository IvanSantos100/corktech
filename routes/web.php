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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function(){  //, 'check-permission:nacional|distribuidora|revenda'
    Route::resource('classes', 'ClassesController');
    Route::resource('estampas', 'EstampasController');
    Route::resource('tipoprodutos', 'TipoProdutosController');
    Route::resource('produtos', 'ProdutosController');
    Route::resource('centrodistribuicoes', 'CentroDistribuicoesController');
    Route::resource('estoques', 'EstoquesController');
    Route::get('estoques/{produto}/details', 'EstoquesController@details')->name('estoques.details');
    Route::resource('clientes', 'ClientesController');
    Route::resource('pedidos', 'PedidosController');
    Route::resource('itenspedidos', 'ItensPedidosController');
    Route::resource('usuarios', 'UsuariosController');
});

