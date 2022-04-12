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
Route::get('/public', function() {
    return redirect('home');
});
Route::get('/home', [MainStoreController::class, 'index'])->name('home');
Route::get('/catalogue', [MainStoreController::class, 'catalogue'])->name('catalogue');
Route::get('/detail/{id}', [MainStoreController::class, 'detail'])->name('detail');
Route::get('/cart', [MainStoreController::class, 'cart'])->name('cart');
Route::get('/getincart', [MainStoreController::class, 'getAllInCart'])->name('getincart');
Route::get('/checkout', [MainStoreController::class, 'checkout'])->name('checkout');
Route::post('/checkout_process', [MainStoreController::class, 'checkout_process'])->name('checkout_process');
Route::get('/direct_whatsapp/{id}', [MainStoreController::class, 'direct_whatsapp'])->name('direct_whatsapp');
Route::get('/checkouted_info/{id}', [MainStoreController::class, 'checkouted_info'])->name('checkouted_info');
Route::get('/checkorder', [MainStoreController::class, 'checkorder'])->name('checkorder');
Route::post('/checkorder_process', [MainStoreController::class, 'checkorder_process'])->name('checkorder_process');

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
Route::prefix('administrator')->middleware('App\Http\Middleware\IsLoggedInMiddleware')->group(function () {

    // Admin: Banner
    Route::get('/banner', 'App\Http\Controllers\BannerController@index')->name('banner.list');
    Route::get('/banner/add', 'App\Http\Controllers\BannerController@create')->name('banner.create');
    Route::post('/banner/add_process', 'App\Http\Controllers\BannerController@store')->name('banner.store');
    Route::get('/banner/detail/{id}', 'App\Http\Controllers\BannerController@edit')->name('banner.edit');
    Route::post('/banner/edit_process/{id}', 'App\Http\Controllers\BannerController@update')->name( 'banner.update');
    Route::delete('/banner/destroy/{id}', 'App\Http\Controllers\BannerController@destroy')->name('banner.destroy');
    Route::get('/banner/tablelist', 'App\Http\Controllers\BannerController@getForTable')->name('banner.tablelist');

    // Admin: Produk
    Route::resource('produk', 'App\Http\Controllers\ProdukController')->except(['update','destroy']);
    Route::post('/produk/update/{id}', 'App\Http\Controllers\ProdukController@update')->name('produk.update');
    Route::post('/produk/destroy/{id}', 'App\Http\Controllers\ProdukController@destroy')->name('produk.destroy');
    Route::post('/produk/editstok/{id}', 'App\Http\Controllers\ProdukController@editStok')->name('produk.editstok');

    // Admin: Kategori
    Route::resource('kategori', 'App\Http\Controllers\KategoriController')->except(['update', 'destroy']);
    Route::post('/kategori/update/{id}', 'App\Http\Controllers\KategoriController@update')->name('kategori.update');
    Route::post('/kategori/destroy/{id}', 'App\Http\Controllers\KategoriController@destroy')->name('kategori.destroy');
    Route::get('/tablelist', 'App\Http\Controllers\KategoriController@getForTable')->name('kategori.tablelist');
    
    // Admin: Tag
    Route::get('/tag', 'App\Http\Controllers\TagController@index')->name('tag.list');
    Route::get('/tag/add', 'App\Http\Controllers\TagController@create')->name('tag.create');
    Route::post('/tag/add_process', 'App\Http\Controllers\TagController@store')->name('tag.store');
    Route::get('/tag/detail/{id}', 'App\Http\Controllers\TagController@edit')->name('tag.edit');
    Route::post('/tag/edit_process/{id}', 'App\Http\Controllers\TagController@update')->name( 'tag.update');
    Route::delete('/tag/destroy/{id}', 'App\Http\Controllers\TagController@destroy')->name('tag.destroy');
    Route::get('/tag/tablelist', 'App\Http\Controllers\TagController@getForTable')->name('tag.tablelist');

    // Admin: Ukuran
    Route::get('/ukuran', 'App\Http\Controllers\UkuranController@index')->name('ukuran.list');
    Route::get('/ukuran/add', 'App\Http\Controllers\UkuranController@create')->name('ukuran.create');
    Route::post('/ukuran/add_process', 'App\Http\Controllers\UkuranController@store')->name('ukuran.store');
    Route::get('/ukuran/detail/{id}', 'App\Http\Controllers\UkuranController@edit')->name('ukuran.edit');
    Route::post('/ukuran/edit_process/{id}', 'App\Http\Controllers\UkuranController@update')->name( 'ukuran.update');
    Route::delete('/ukuran/destroy/{id}', 'App\Http\Controllers\UkuranController@destroy')->name('ukuran.destroy');
    Route::get('/ukuran/tablelist', 'App\Http\Controllers\UkuranController@getForTable')->name('ukuran.tablelist');
    
    // Admin: Gambar
    Route::post('/img/delete/{id}', 'App\Http\Controllers\GambarController@destroy')->name('gambar.destroy');

    //  Admin: Transaksi
    Route::get('/transaksi/neworder', 'App\Http\Controllers\TransaksiController@neworder')->name('transaksi.neworder');
    Route::post('/transaksi/update_status/{id}', 'App\Http\Controllers\TransaksiController@update_status')->name('transaksi.update_status');
    //status baru
    Route::get('/transaksi/neworder_data', 'App\Http\Controllers\TransaksiController@neworder_data')->name('transaksi.neworder_data');
    Route::get('/transaksi/getone_data/{id}', 'App\Http\Controllers\TransaksiController@getone_data')->name('transaksi.getone_data');
    //status dibayar
    Route::get('/transaksi/dibayar', 'App\Http\Controllers\TransaksiController@dibayar')->name('transaksi.dibayar');
    Route::get('/transaksi/dibayar_data', 'App\Http\Controllers\TransaksiController@dibayar_data')->name('transaksi.dibayar_data');
    //status dikemas
    Route::get('/transaksi/dikemas', 'App\Http\Controllers\TransaksiController@dikemas')->name('transaksi.dikemas');
    Route::get('/transaksi/dikemas_data', 'App\Http\Controllers\TransaksiController@dikemas_data')->name('transaksi.dikemas_data');
    //status dikirim
    Route::get('/transaksi/dikirim', 'App\Http\Controllers\TransaksiController@dikirim')->name('transaksi.dikirim');
    Route::get('/transaksi/dikirim_data', 'App\Http\Controllers\TransaksiController@dikirim_data')->name('transaksi.dikirim_data');
    //status selesai
    Route::get('/transaksi/selesai', 'App\Http\Controllers\TransaksiController@selesai')->name('transaksi.selesai');
    Route::get('/transaksi/selesai_data', 'App\Http\Controllers\TransaksiController@selesai_data')->name('transaksi.selesai_data');
    //detele transaksi
    Route::post('/transaksi/delete/{id}', 'App\Http\Controllers\TransaksiController@destroy')->name('transaksi.destroy');
});



