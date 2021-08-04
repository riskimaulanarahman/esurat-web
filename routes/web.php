<?php

use Illuminate\Support\Facades\Route;

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
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


Route::get('/', 'HomeController@index');

Route::group( ['as' => 'admin.','middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/', 'HomeController@index')->name('index');

    // Show Halaman Master Surat
    Route::get('/surat-masuk','masterdatasurat\suratmasuk\SuratmasukController@show')->name('suratmasuk');
    Route::get('/surat-keluar','masterdatasurat\suratkeluar\SuratkeluarController@show')->name('suratkeluar');

    // Show Halaman Kelola User
    Route::get('/master-user','masteruser\LoginUserController@show')->name('masteruser');
    Route::get('/master-jabatan','masteruser\JabatanController@show')->name('masterjabatan');
    Route::get('/master-karyawan','masteruser\KaryawanController@show')->name('masterkaryawan');

});

Route::group( ['as' => 'user.','middleware' => ['auth']], function() {
    // Disposisi Surat
    Route::get('/disposisi-surat-masuk','API\DisposisiController@showsuratmasuk')->name('disposisi.suratmasuk');
    Route::get('/disposisi-surat-keluar','API\DisposisiController@showsuratkeluar')->name('disposisi.suratkeluar');

});

// Route::apiResource('/api/disposisi-api','API\DisposisiController');


require __DIR__.'/auth.php';
