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

//master data surat

Route::apiResource('/surat-masuk','masterdatasurat\suratmasuk\SuratmasukController');
Route::apiResource('/surat-keluar','masterdatasurat\suratkeluar\SuratkeluarController');

Route::apiResource('/disposisi-api','API\DisposisiController');

// Route::apiResource('/surat-pelayanan','masterdatasurat\suratpelayanan\SuratpelayananController');
Route::post('/upload-berkas/{id}/{module}','BerkasController@update')->name('uploadberkas');

Route::post('/send-disposisi','API\DisposisiController@senddisposisi')->name('senddisposisi');
Route::post('/aksi-disposisi','API\DisposisiController@aksi')->name('aksidisposisi');
Route::get('/getdetail-disposisi','API\DisposisiController@getdetail')->name('getdetail.disposisi');

//master user
Route::apiResource('/master-user','masteruser\LoginUserController');
Route::apiResource('/master-karyawan','masteruser\KaryawanController');
Route::apiResource('/master-jabatan','masteruser\JabatanController');

//list
Route::post('list-jabatan','API\ListController@listJabatan');

//check
Route::get('/status-suratmasuk/{id}','masterdatasurat\suratmasuk\SuratmasukController@checksuratmasuk')->name('status.suratmasuk');
Route::get('/status-suratkeluar/{id}','masterdatasurat\suratkeluar\SuratkeluarController@checksuratkeluar')->name('status.suratkeluar');
Route::get('/status-disposisi/{id}','API\DisposisiController@checkdisposisi')->name('status.disposisi');

Route::post('getlogin','API\ListController@getlogin');

Route::get('/test-api','API\TestController@index');
