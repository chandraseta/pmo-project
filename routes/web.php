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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/pages', 'PagesController@landing');

Route::get('/pages/profile', 'PagesController@pegawai');

Route::get('/pages/pmo', 'PagesController@pmo');

Route::get('/pages/admin', 'PagesController@admin');

Route::get('/pages/admin/adduser', 'PagesController@addUser');

Route::get('/pages/pimage/{filename}', 'PhotoController@profile');

Route::get('/pages/simage/{filename}', 'PhotoController@sertifikat');