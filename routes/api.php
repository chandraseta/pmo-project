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

Route::get('pegawai/export', 'Pegawai\PegawaiAPIController@export');

Route::resource('pegawai', 'Pegawai\PegawaiAPIController');

Route::resource('user', 'User\UserAPIController');

Route::get('kompetensi/export', 'DataKompetensiController@export');

Route::post('kompetensi/import', 'DataKompetensiController@import');

Route::get('kompetensi/report/{id}', 'DataKompetensiController@generateReport');

Route::resource('kompetensi', 'DataKompetensiController');

Route::get('kinerja/export', 'DataKinerjaController@export');

Route::post('kinerja/import', 'DataKinerjaController@import');

Route::resource('kinerja', 'DataKinerjaController');

Route::resource('pegawai-denormalized', 'DataPegawaiController');

Route::resource('training', 'TrainingController');

Route::resource('kepegawaian', 'KepegawaianController');

Route::resource('riwayat', 'RiwayatController');

Route::resource('sertifikat', 'SertifikatController');

