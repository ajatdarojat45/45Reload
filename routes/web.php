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
   if (!Auth::guest()) {
      return view('dashboard');
   }
    return view('login');
});


Auth::routes();

Route::get('/home', function () {
   return redirect('dashboard');
});

Route::group(['middleware' =>'auth'], function(){
   Route::get('/dashboard', function () {
      return view('dashboard');
   })->name('dashboard');

   // test
   Route::get('importExport', 'MaatwebsiteDemoController@importExport');
   Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
   Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

   // deposits
   Route::get('deposit/index', 'DepositController@index')->name('deposit/index');
   Route::post('deposit/importExcel', 'DepositController@importExcel')->name('deposit/importExcel');

   // Transaction
   Route::get('transaction/index', 'TransactionController@index')->name('transaction/index');
   Route::post('transaction/importExcel', 'TransactionController@importExcel')->name('transaction/importExcel');

   // Transfers
   Route::get('transfer/index', 'TransferController@index')->name('transfer/index');
   Route::post('transfer/importExcel', 'TransferController@importExcel')->name('transfer/importExcel');
});
