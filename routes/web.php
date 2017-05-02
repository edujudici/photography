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

Route::group(['middleware' => 'auth'], function ()
{
	
	Route::get('/home', 'HomeController@index');


    // Route::get ('/listar/{id?}',  ['as' => 'galeria.listar',  'uses' => 'ImagemController@listar']);
    // Route::post('/salvar',  ['as' => 'galeria.salvar',  'uses' => 'ImagemController@salvar']);
    // Route::post('/ordenar',  ['as' => 'galeria.ordenar',  'uses' => 'ImagemController@ordenar']);
    // Route::post('/excluir', ['as' => 'galeria.excluir', 'uses' => 'ImagemController@excluir']);
    

});


