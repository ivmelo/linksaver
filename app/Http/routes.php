<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LinkController@index');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// For editing account information.
Route::get('user/{id}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
Route::patch('user/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);

Route::resource('link', 'LinkController');
