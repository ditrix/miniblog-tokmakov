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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'PostController@index')->name('blog.index');

Route::get('post/index', 'PostController@index')->name('post.index');
Route::get('post/search', 'PostController@search')->name('post.search');

Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post/store', 'PostController@store')->name('post.store');

Route::get('post/show/{id}', 'PostController@show')->name('post.show');

Route::get('post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::patch('post/update/{id}', 'PostController@update')->name('post.update');

