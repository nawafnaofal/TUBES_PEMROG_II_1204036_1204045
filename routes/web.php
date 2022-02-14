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

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('emailver', 'Auth\RegisterController@emailver')->name('emailver');
Route::post('verify', 'Auth\RegisterController@verify')->name('verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('pesan/{id}', 'PesanController@index');
Route::post('pesan/{id}', 'PesanController@pesan');
Route::get('check-out', 'PesanController@check_out');
Route::delete('check-out/{id}', 'PesanController@delete');

Route::post('konfirmasi-check-out/{id}', 'PesanController@konfirmasi');
Route::get('konfirmasipesanan/{id}', 'HistoryController@konfirmasipesanan')->name('konfirmasipesanan');

Route::get('profile', 'ProfileController@index');
Route::post('profile', 'ProfileController@update');

Route::get('history', 'HistoryController@index');
Route::get('history/{id}', 'HistoryController@detail');
Route::post('batal/{id}', 'HistoryController@batal');

Route::get('display/{id}', 'HomeController@display');

Route::get('/', function () {
    if (Auth::check()) {
        if (auth()->user()->roles == 'ADMIN') {
            return redirect('dashboard');
        }
    }

    return redirect('login');
});

Route::namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('barang', 'DashboardController@databarang')->name('barang');
        Route::get('kategori', 'DashboardController@datakategori')->name('kategori');
        Route::get('pesananmasuk', 'DashboardController@pesananmasuk')->name('pesananmasuk');
        Route::get('historipesanan', 'DashboardController@historipesanan')->name('historipesanan');
        Route::get('pelanggan', 'DashboardController@pelanggan')->name('pelanggan');
        Route::get('editbarang/{id}', 'DashboardController@editbarang');
        Route::get('detailpesanan/{id}', 'DashboardController@detailpesanan')->name('detailpesanan');
        Route::get('adminprofile', 'DashboardController@adminprofile')->name('adminprofile');

        Route::post('simpankategori', 'DashboardController@simpankategori');
        Route::post('simpanbarang', 'DashboardController@simpanbarang');

        Route::post('ubahbarang/{id}', 'DashboardController@ubahbarang')->name('ubahbarang');
        Route::get('antarpesanan/{id}', 'DashboardController@antarpesanan')->name('antarpesanan');
        Route::post('editprofile', 'DashboardController@editprofile');
        Route::get('selesai/{id}', 'DashboardController@selesai')->name('selesai');
        Route::post('tambahpenerima/{id}', 'DashboardController@tambahpenerima')->name('tambahpenerima');
        Route::post('batalpesanan/{id}', 'DashboardController@batalpesanan')->name('batalpesanan');

        Route::delete('barang/{id}', 'DashboardController@hapusbarang')->name('hapusbarang');
    });
