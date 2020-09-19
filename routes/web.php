<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');
//Tabel Makanan
Route::get('tabel_makanan','KantinController@index')->name('kantin');
Route::get('form', 'KantinController@create')->name('form');
Route::post('add_menu', 'KantinController@Store')->name('tambah.menu');
Route::get('form_edit/{id}', 'KantinController@edit')->name('edit.menu');
Route::post('update', 'KantinController@update')->name('update.menu');
Route::get('del_menu/{id}', 'KantinController@destroy')->name('delete.menu');
//Menu
Route::get('menu','HomeController@index');
//Order Menu
Route::post('/menu/{id}', 'HomeController@order');
//Keranjang
Route::get('/keranjang', 'HomeController@keranjang');
//Delete keranjang
Route::delete('/keranjang/{id}','HomeController@destroy');
//Transaksi
Route::post('/keranjang/bayar/{id}', 'HomeController@payment');