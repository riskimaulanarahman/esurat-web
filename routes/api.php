<?php

use Illuminate\Http\Request;

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
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
Route::get('/cetakpdfsm/{id}','masterdatasurat\suratmasuk\SuratmasukController@cetakpdfsm')->name('cetakpdfsm');
// Route::get('/suratmasuk-updateandroid/{id}','masterdatasurat\suratmasuk\SuratmasukController@updateandroid')->name('sm.updateandroid');

Route::apiResource('/surat-keluar','masterdatasurat\suratkeluar\SuratkeluarController');

Route::apiResource('/disposisi-api','API\DisposisiController');
Route::apiResource('/disposisi-ionic','API\DisposisiIonicController');

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
Route::post('list-karyawan','API\ListController@listKaryawan');
Route::get('dashboard-count','API\ListController@dashboardadmin');

//check
Route::get('/status-suratmasuk/{id}','masterdatasurat\suratmasuk\SuratmasukController@checksuratmasuk')->name('status.suratmasuk');
Route::get('/status-suratkeluar/{id}','masterdatasurat\suratkeluar\SuratkeluarController@checksuratkeluar')->name('status.suratkeluar');
Route::get('/status-disposisi/{id}','API\DisposisiController@checkdisposisi')->name('status.disposisi');

Route::post('getlogin','API\ListController@getlogin');
Route::get('checknik/{nik}','API\ListController@checkusernik');
Route::get('alluser','API\ListController@alluser');

Route::get('/test-api','API\TestController@index');
