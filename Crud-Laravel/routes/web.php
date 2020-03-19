<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', 'FormController@index');
Route::get('/form/create', 'FormController@create');
Route::post('/form', 'FormController@store')->name('store_FormFactory');
Route::get('/form/{id}/edit', 'FormController@edit');
Route::put('/form/{id}', 'FormController@update')->name('update_FormFactory');
Route::get('/form/{id}', 'FormController@show');

Route::resource('form', 'FormController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::delete('/form/{id}', 'FormController@destroy')->name('delete_FormFactory');
Route::delete('myproductsDeleteAll', 'FormController@deleteAll');