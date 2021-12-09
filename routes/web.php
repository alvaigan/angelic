<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainStoreController;

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
// Store
Route::get('/', [MainStoreController::class, 'index'])->name('home');
Route::get('/home', [MainStoreController::class, 'index'])->name('home');
Route::get('/catalogue', [MainStoreController::class, 'catalogue'])->name('catalogue');
Route::get('/detail/{id}', [MainStoreController::class, 'detail'])->name('detail');

// Login
Route::get('/login', 'App\Http\Controllers\AuthorController@index')->name('login.page');
Route::post('/login', 'App\Http\Controllers\AuthorController@loginProcess')->name('login.process');
Route::get('/logout', 'App\Http\Controllers\AuthorController@logout')->name('logout');

// Admin: Dashboard 
Route::get('/administrator', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

// Admin: Menu User
Route::get( '/administrator/user', 'App\Http\Controllers\UserController@index')->name('user.list');
Route::get('/administrator/user/list', 'App\Http\Controllers\UserController@getForList')->name('user.tablelist');
Route::get('/administrator/user/add', 'App\Http\Controllers\UserController@add')->name('user.add');
Route::post('/administrator/user/add_process', 'App\Http\Controllers\UserController@addProcess')->name('user.add_process');
Route::get('/administrator/user/detail/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('/administrator/user/edit_process', 'App\Http\Controllers\UserController@editProcess')->name('user.edit_process');
Route::post('/administrator/user/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');

// Admin: Kecamatan
Route::get('/administrator/kec', 'App\Http\Controllers\KecamatanController@index')->name('kec.list');
Route::get('/administrator/kec/add', 'App\Http\Controllers\KecamatanController@add')->name('kec.add');
Route::get('/administrator/kec/add_process', 'App\Http\Controllers\KecamatanController@addProcess')->name('kec.add_process');
Route::get('/administrator/kec/detail/{id}', 'App\Http\Controllers\KecamatanController@edit')->name('kec.edit');
Route::get('/administrator/kec/edit_process', 'App\Http\Controllers\KecamatanController@editProcess')->name( 'kec.edit_process');
Route::get('/administrator/kec/destroy/{id}', 'App\Http\Controllers\KecamatanController@destroy');

// Admin: Kota
Route::get('/administrator/kota', 'App\Http\Controllers\KotaController@index')->name('kota.list');
Route::get('/administrator/kota/add', 'App\Http\Controllers\KotaController@add')->name('kota.add');
Route::get('/administrator/kota/add_process', 'App\Http\Controllers\KotaController@addProcess')->name('kota.add_process');
Route::get('/administrator/kota/detail/{id}', 'App\Http\Controllers\KotaController@edit')->name('kota.edit');
Route::get('/administrator/kota/edit_process', 'App\Http\Controllers\KotaController@editProcess')->name('kota.edit_process');
Route::get('/administrator/kota/destroy/{id}', 'App\Http\Controllers\KotaController@destroy');

// Admin: Provinsi
Route::get('/administrator/provinsi', 'App\Http\Controllers\ProvinsiController@index')->name('provinsi.list');
Route::get('/administrator/provinsi/add', 'App\Http\Controllers\ProvinsiController@add')->name('provinsi.add');
Route::get('/administrator/provinsi/add_process', 'App\Http\Controllers\ProvinsiController@addProcess')->name('provinsi.add_process');
Route::get('/administrator/provinsi/detail/{id}', 'App\Http\Controllers\ProvinsiController@edit')->name('provinsi.edit');
Route::get('/administrator/provinsi/edit_process', 'App\Http\Controllers\ProvinsiController@editProcess')->name('provinsi.edit_process');
Route::get('/administrator/provinsi/destroy/{id}', 'App\Http\Controllers\ProvinsiController@destroy');

Route::get('/administrator/produk/tablelist', 'App\Http\Controllers\ProdukController@getForTable')->name('produk.tablelist');
Route::prefix('administrator')->group(function () {
    // Admin: Produk
    Route::resource('produk', 'App\Http\Controllers\ProdukController')->except(['update','destroy']);
    Route::post('/produk/update/{id}', 'App\Http\Controllers\ProdukController@update')->name('produk.update');
    Route::post('/produk/destroy/{id}', 'App\Http\Controllers\ProdukController@destroy')->name('produk.destroy');

    // Admin: Kategori
    Route::resource('kategori', 'App\Http\Controllers\KategoriController')->except(['update', 'destroy']);
    Route::post('/kategori/update/{id}', 'App\Http\Controllers\KategoriController@update')->name('kategori.update');
    Route::post('/kategori/destroy/{id}', 'App\Http\Controllers\KategoriController@destroy')->name('kategori.destroy');
    Route::get('/tablelist', 'App\Http\Controllers\KategoriController@getForTable')->name('kategori.tablelist');
});



