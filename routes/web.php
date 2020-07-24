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

// Route::get('/', function () {
//     return view('site.welcome');
// });
Route::get('/', 'FrontController@home');
Route::get('/about', 'FrontController@about');
Route::get('/katalog', 'FrontController@katalog');
Route::get('/load', 'FrontController@load');
Route::get('/katalog/{id}', 'FrontController@kateg');
Route::get('/reg', 'FrontController@reg');
Route::post('/postreg', 'FrontController@postreg');
Route::get('/katalogdet/{id}', 'FrontController@katalogdet');


Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/dashboard', 'DashboardController@index');
Route::resource('user', 'UserController');

Route::resource('pegawai', 'PegawaiController');

Route::resource('anggota', 'AnggotaController');

Route::resource('buku', 'BukuController');
Route::resource('kategori', 'KategoriController');
Route::resource('rak', 'RakController');
Route::resource('post', 'PostController');
Route::resource('denda', 'DendaController');

Route::resource('transaksi', 'TransaksiController');
Route::get('/book', 'TransaksiController@book');
Route::get('/pinjam', 'TransaksiController@pinjam');
Route::get('/kembali', 'TransaksiController@kembali');
Route::get('/batal', 'TransaksiController@batal');

Route::get('/laporan', 'LaporanController@index');
Route::get('/laporan/exportExcel', 'LaporanController@exportExcel');
Route::get('/laporan/exportExcelKateg', 'LaporanController@exportExcelKateg');
Route::get('/laporan/exportExcelRak', 'LaporanController@exportExcelRak');
Route::get('/laporan/trsExcel', 'LaporanController@trsExcel');
Route::post('/laporan/trsExcelTgl', 'LaporanController@trsExcelTgl');

Route::get('/laporan/exportPdf', 'LaporanController@exportPdf');
Route::get('/laporan/exportPdfKateg/{id}', 'LaporanController@exportPdfKateg');
Route::get('/laporan/exportPdfRak/{id}', 'LaporanController@exportPdfRak');
Route::get('/laporan/trsPdf', 'LaporanController@trsPdf');
Route::post('/laporan/trsPdfTgl', 'LaporanController@trsPdfTgl');

Route::get('/denah', 'DenahController@index');
Route::post('/denah/sv', 'DenahController@store');
Route::get('/load', 'DenahController@load');
Route::post('/denah/up', 'DenahController@edit');
Route::delete('/denah/delete/{id}', 'DenahController@destroy');

Auth::routes();

Route::get('/{slug}',[
  'uses' => 'FrontController@singlepost',
  'as' => 'site.single.post'
]);
