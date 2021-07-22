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


Route::get('/', 'HomeController@index');
Route::get('/absensi', 'API\AbsensiController@index');
Route::get('/form-absensi/{kode}', 'API\AbsensiController@formabsensi');
Route::apiResource('/api/data-absensi','API\ReportController');

Route::group( ['as' => 'admin.','middleware' => ['auth']], function() {

    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/surat-masuk','masterdatasurat\suratmasuk\SuratmasukController@show')->name('suratmasuk');
    Route::get('/surat-keluar','masterdatasurat\suratkeluar\SuratkeluarController@show')->name('suratkeluar');
    Route::get('/surat-pelayanan','masterdatasurat\suratpelayanan\SuratpelayananController@show')->name('suratpelayanan');

    //referensi
    Route::get('/ref-penduduk','referensi\pendudukController@show')->name('refpenduduk');
    Route::get('/ref-suratpelayanan','referensi\suratpelayananController@show')->name('refsuratpelayanan');
    Route::get('/ref-kelengkapansuratpelayanan','referensi\kelengkapansuratpelayananController@show')->name('refkelengkapansuratpelayanan');

    //master user
    Route::get('/master-user','masteruser\LoginUserController@show')->name('masteruser');
    Route::get('/master-jabatan','masteruser\JabatanController@show')->name('masterjabatan');
    Route::get('/master-karyawan','masteruser\KaryawanController@show')->name('masterkaryawan');
    //
    Route::get('/generate-qr','API\GenerateController@show')->name('generateqr');

    Route::get('/data-absensi','API\ReportController@show')->name('report');

    Route::get('/test-api','API\TestController@index')->name('test');

});

Route::group( ['as' => 'user.','middleware' => ['auth']], function() {

    Route::get('/disposisi-surat-masuk','API\DisposisiController@showsuratmasuk')->name('disposisi.suratmasuk');
    Route::get('/disposisi-surat-keluar','API\DisposisiController@showsuratkeluar')->name('disposisi.suratkeluar');

    
});

// Route::apiResource('/api/disposisi-api','API\DisposisiController');


require __DIR__.'/auth.php';
