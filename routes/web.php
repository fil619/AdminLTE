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
    return view('welcome');
});
Route::get('/app', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('setexpense/getiexpenses', 'ExpenseController@getiexpenses');
Route::get('setexpense/getexpenses', 'ExpenseController@getexpenses');
Route::resource('/setexpense', 'ExpenseController');

Route::get('/ledger/asset', 'LedgerController@asset');
Route::get('/ledger/liab', 'LedgerController@liab');
Route::get('/ledger/capital', 'LedgerController@capital');
Route::get('/ledger/direct', 'LedgerController@direct');
Route::get('/ledger/indirect', 'LedgerController@indirect');
Route::resource('/ledger', 'LedgerController');

Route::get('/balancesheet/getliabsum', 'BalancesheetController@getliabsum');
Route::get('/balancesheet/getdetails', 'BalancesheetController@getdetails');
Route::resource('/balancesheet', 'BalancesheetController');
Route::resource('/asset', 'AssetController');
