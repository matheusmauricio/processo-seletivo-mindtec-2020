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

Route::get('listar-clientes', ['uses' => 'ClientesController@listar']);

Route::get('detalhar-cliente/{id}', ['uses' => 'ClientesController@detalhar']);

Route::get('cadastrar-cliente', function () {
    return view('cadastrar-cliente');
});

Route::post('cadastrar-cliente', ['uses' => 'ClientesController@cadastrar']);

Route::post('editar-cliente', ['uses' => 'ClientesController@editar']);

Route::post('excluir-cliente', ['uses' => 'ClientesController@excluir']);

Route::post('procurar-cliente', ['uses' => 'ClientesController@procurar']);

Route::get('mostrar-clientes/{razaoSocial}', ['as'=> 'mostrarClientes', 'uses'=>'ClientesController@mostrarClientes']);

Route::get('mostrar-clientes/', ['uses' => 'ClientesController@listar']);


Route::get('cadastrar-contato-cliente/{id}', ['uses' => 'ContatosClientesController@cadastrarContato']);

Route::post('cadastrar-contato-cliente', ['uses' => 'ContatosClientesController@cadastrar']);

Route::get('detalhar-contato-cliente/{id}', ['uses' => 'ContatosClientesController@detalhar']);

Route::post('editar-contato', ['uses' => 'ContatosClientesController@editar']);

Route::post('excluir-contato', ['uses' => 'ContatosClientesController@excluir']);