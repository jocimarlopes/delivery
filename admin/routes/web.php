<?php

use Illuminate\Support\Facades\Route;

Route::any('products/search', 'ProdutoController@search')->name('products.search')->middleware('auth');
Route::resource('products', 'ProdutoController')->middleware('auth');
Route::resource('vendas', 'Bkp_VendaController')->middleware('auth');
Route::resource('categorias', 'ProdutoCategoriaController')->middleware('auth');
Route::resource('carrinho', 'CarController')->middleware('auth');
Route::resource('locais', 'LocalController')->middleware('auth');
Route::resource('config', 'ConfController')->middleware('auth');

/**
 * Rota Modal id_venda
 */
Route::get('/home/$id', 'HomeController@idModal');

/**
 * Rota Limpar Cache Painel
 */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('/login', function () {
    return 'Login';
})->name('login');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::delete('home/{id}', 'HomeController@destroy')->name('home.destroy');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

