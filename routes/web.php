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

Route::post('/create_sign', 'SigndocumentController@create_signdocument');
Route::get('/create_sign/{id}', 'SigndocumentController@sign_screen');
Route::post('/sign/{id}', 'SigndocumentController@sign');
Route::get('/check_sign/{id}', 'SigndocumentController@sign_check');
Route::get('/download/{id}', 'SigndocumentController@download');

