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


Route::get('/', 'ProductController@index');

Route::post('/product/store', 'ProductController@store');
Route::delete('/product/delete/{id}', 'ProductController@delete');
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'AuthController@login');
Route::get('/product/edit/{id}', 'ProductController@edit');
