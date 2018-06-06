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

Route::get('/register', function () {
   if (!Auth::guest()) {
      return view('dashboard');
   }
    return view('register');
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
   Route::post('deposit/store', 'DepositController@store')->name('deposit/store');
   Route::get('deposit/report', 'DepositController@report')->name('deposit/report');
   Route::get('deposit/destroy/{id}', 'DepositController@destroy')->name('deposit/destroy');
   Route::post('deposit/importExcel', 'DepositController@importExcel')->name('deposit/importExcel');
   Route::post('deposit/multipleDestroy', 'DepositController@multipleDestroy')->name('deposit/multipleDestroy');
   Route::get('deposit/exportToPdf/{date1}/{date2}', 'DepositController@exportToPdf')->name('deposit/exportToPdf');
   Route::get('deposit/exportToExcel/{date1}/{date2}/{type}', 'DepositController@exportToExcel')->name('deposit/exportToExcel');

   // Transaction
   Route::get('transaction/index', 'TransactionController@index')->name('transaction/index');
   Route::post('transaction/store', 'TransactionController@store')->name('transaction/store');
   Route::get('transaction/report', 'TransactionController@report')->name('transaction/report');
   Route::get('transaction/destroy/{id}', 'TransactionController@destroy')->name('transaction/destroy');
   Route::post('transaction/importExcel', 'TransactionController@importExcel')->name('transaction/importExcel');
   Route::post('transaction/multipleDestroy', 'TransactionController@multipleDestroy')->name('transaction/multipleDestroy');
   Route::get('transaction/exportToPdf/{date1}/{date2}', 'TransactionController@exportToPdf')->name('transaction/exportToPdf');
   Route::get('transaction/exportToExcel/{date1}/{date2}/{type}', 'TransactionController@exportToExcel')->name('transaction/exportToExcel');

   // Transfers
   Route::get('transfer/index', 'TransferController@index')->name('transfer/index');
   Route::post('transfer/store', 'TransferController@store')->name('transfer/store');
   Route::get('transfer/report', 'TransferController@report')->name('transfer/report');
   Route::get('transfer/destroy/{id}', 'TransferController@destroy')->name('transfer/destroy');
   Route::post('transfer/importExcel', 'TransferController@importExcel')->name('transfer/importExcel');
   Route::post('transfer/multipleDestroy', 'TransferController@multipleDestroy')->name('transfer/multipleDestroy');
   Route::get('transfer/exportToPdf/{date1}/{date2}', 'TransferController@exportToPdf')->name('transfer/exportToPdf');
   Route::get('transfer/exportToExcel/{date1}/{date2}/{type}', 'TransferController@exportToExcel')->name('transfer/exportToExcel');
});
