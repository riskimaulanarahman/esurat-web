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

// Cetak PDF
Route::get('/cetakpdfsm/{id}','masterdatasurat\suratmasuk\SuratmasukController@cetakpdfsm')->name('cetakpdfsm');
Route::get('/cetakpdfsk/{id}','masterdatasurat\suratkeluar\SuratkeluarController@cetakpdfsk')->name('cetakpdfsk');

// CRUD Surat Masuk & Surat Keluar
Route::apiResource('/surat-masuk','masterdatasurat\suratmasuk\SuratmasukController');
Route::apiResource('/surat-keluar','masterdatasurat\suratkeluar\SuratkeluarController');

// Upload Berkas Surat Masuk & Surat Keluar
Route::post('/upload-berkas/{id}/{module}','BerkasController@update')->name('uploadberkas');

// Disposisi Web
Route::apiResource('/disposisi-api','API\DisposisiController');
Route::post('/send-disposisi','API\DisposisiController@senddisposisi')->name('senddisposisi');
Route::post('/aksi-disposisi','API\DisposisiController@aksi')->name('aksidisposisi');
Route::get('/getdetail-disposisi','API\DisposisiController@getdetail')->name('getdetail.disposisi'); // menampilkan detail disposisi pada surat masuk & surat keluar

// Disposisi Android (ionic)
Route::apiResource('/disposisi-ionic','API\DisposisiIonicController');

// Kelola User
Route::apiResource('/master-user','masteruser\LoginUserController');
Route::apiResource('/master-karyawan','masteruser\KaryawanController');
Route::apiResource('/master-jabatan','masteruser\JabatanController');

// List Refrensi
Route::post('list-jabatan','API\ListController@listJabatan');
Route::post('list-karyawan','API\ListController@listKaryawan');

// Perhitungan Jumlah Disposisi
Route::get('dashboard-count','API\ListController@dashboardadmin');

// Check Validasi
Route::get('/status-suratmasuk/{id}','masterdatasurat\suratmasuk\SuratmasukController@checksuratmasuk')->name('status.suratmasuk');
Route::get('/status-suratkeluar/{id}','masterdatasurat\suratkeluar\SuratkeluarController@checksuratkeluar')->name('status.suratkeluar');
Route::get('/status-disposisi/{id}','API\DisposisiController@checkdisposisi')->name('status.disposisi');

// Login android (ionic)
Route::get('alluser','API\ListController@alluser'); // get all user
Route::post('getlogin','API\ListController@getlogin'); // get user & pass
Route::get('checknik/{nik}','API\ListController@checkusernik'); // check user nik

Route::get('/test-api','API\TestController@index');
