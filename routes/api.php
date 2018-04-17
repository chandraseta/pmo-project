<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('templates/{template}', 'FileDownloadController@downloadTemplate');

Route::resource('pegawai', 'Pegawai\PegawaiAPIController');

Route::resource('user', 'User\UserAPIController');

Route::resource('kompetensi', 'DataKompetensiController');

Route::resource('kinerja', 'DataKinerjaController');