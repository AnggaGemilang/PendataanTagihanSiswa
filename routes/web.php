<?php

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

Route::group(['middleware' => ['auth','roleMiddleware:1,2,3']], function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('ubahpassword', 'ProfilController@ubahpassword')->name('ubahpassword');
    Route::get('ubahpassword/fetch/{old}', 'ProfilController@fetch_oldpassword')->name('ubahpassword_fetch');
    Route::post('ubahpassword/store', 'ProfilController@resetStore')->name('ubahpassword_stote');

    Route::get('profil/{slug}/{id}/{role_id}', 'ProfilController@index')->name('profile');
    Route::post('profil/{slug}/{id}/{role_id}/perbaharui/store', 'ProfilController@update')->name('perbaharui_profile');

    Route::get('pembayaran/history', 'PembayaranController@history')->name('history');
    Route::get('pembayaran/history/detail/{id}', 'PembayaranController@detail')->name('detail_history');

});

Route::group(['middleware' => ['auth','roleMiddleware:1']], function(){

    Route::get('markAsRead/{id}', 'ProfilController@read')->name('read');
    Route::get('markAsRead', 'ProfilController@notification')->name('read');
    Route::get('pembayaran/data', 'PembayaranController@data')->name('datapembayaran');

});

Route::group(['middleware' => ['auth','roleMiddleware:2']], function(){

    Route::get('pembayaran/cetak_pdf/{jenis_filter}/{periode}', 'PembayaranController@cetak_pdf')->name('cetak_laporan');

    Route::get('data/siswa', 'SiswaController@index')->name('siswa');
    Route::get('data/siswa/detail/{slug}/{id}', 'SiswaController@detail')->name('detail_siswa');
    Route::get('data/siswa/tambah', 'SiswaController@tambah')->name('tambah_siswa');
    Route::get('data/siswa/perbaharui/{slug}/{id}', 'SiswaController@showupdate')->name('perbaharui_siswa');
    Route::post('data/siswa/tambah/store', 'SiswaController@store')->name('tambah_siswa_store');
    Route::post('data/siswa/perbaharui/{id}/store', 'SiswaController@update')->name('perbaharui_siswa_store');
    Route::post('data/siswa/hapus/{id}', 'SiswaController@destroy')->name('hapus_siswa_store');

    Route::get('data/kelas', 'KelasController@index')->name('kelas');
    Route::get('data/kelas/detail/{slug}', 'KelasController@detail')->name('detail_kelas');
    Route::get('data/kelas/perbaharui/{slug}', 'KelasController@showupdate')->name('perbaharui_kelas');
    Route::get('data/kelas/tambah', 'KelasController@tambah')->name('tambah_kelas');
    Route::post('data/kelas/tambah/store', 'KelasController@store')->name('tambah_kelas_store');
    Route::post('data/kelas/perbaharui/{slug}/store', 'KelasController@update')->name('perbaharui_kelas_store');
    Route::post('data/kelas/hapus/{id}', 'KelasController@destroy')->name('hapus_kelas_store');

    Route::get('data/petugas', 'PetugasController@index')->name('petugas');
    Route::get('data/petugas/detail/{slug}', 'PetugasController@detail')->name('detail_petugas');
    Route::get('data/petugas/perbaharui/{slug}/{id}', 'PetugasController@showupdate')->name('perbaharui_petugas');
    Route::get('data/petugas/tambah', 'PetugasController@tambah')->name('tambah_petugas');
    Route::post('data/petugas/tambah/store', 'PetugasController@store')->name('tambah_petugas_store');
    Route::post('data/petugas/perbaharui/{slug}/{id}/store', 'PetugasController@update')->name('perbaharui_petugas_store');
    Route::post('data/petugas/hapus/{id}', 'PetugasController@destroy')->name('hapus_petugas_store');

    Route::get('data/tipetagihan', 'TipeTagihanController@index')->name('tipetagihan');
    Route::get('data/tipetagihan/detail/{slug}/{id}', 'TipeTagihanController@detail')->name('detail_tipetagihan');
    Route::get('data/tipetagihan/tambah', 'TipeTagihanController@tambah')->name('tambah_tipetagihan');
    Route::post('data/tipetagihan/tambah/store/{kelas_id}/{tipetagihan_id}', 'TipeTagihanController@store')->name('tambah_tipetagihan_store');
    Route::get('data/tipetagihan/perbaharui/{slug}', 'TipeTagihanController@showupdate')->name('perbaharui_tipetagihan');
    Route::post('data/tipetagihan/perbaharui/{slug}/store', 'TipeTagihanController@update')->name('perbaharui_tipetagihan_store');
    Route::post('data/tipetagihan/hapus/{id}', 'TipeTagihanController@destroy')->name('hapus_tipetagihan_store');

    Route::get('data/tagihan/perbaharui/{id}', 'TagihanController@showUpdate')->name('perbaharui_tagihan');
    Route::post('data/tagihan/perbaharui/{id}/store', 'TagihanController@update')->name('perbaharui_tagihan_store');
    Route::post('data/tagihan/hapus/{id}', 'TagihanController@destroy')->name('hapus_tagihan_store');

    Route::get('pembayaran/entripembayaran/{kelas_id}/{siswa_id}/{tagihan_id}', 'PembayaranController@autofill')->name('tambah_pembayaran');

});

Route::group(['middleware' => ['auth','roleMiddleware:2,3']], function(){

    Route::get('pembayaran/entripembayaran', 'PembayaranController@index')->name('tambah_pembayaran');
    Route::post('pembayaran/entripembayaran/store', 'PembayaranController@store')->name('tambah_pembayaran_store');
    Route::get('pembayaran/entripembayaran/{id_kelas}/getsiswa', 'PembayaranController@fetch')->name('fetch_siswa');
    Route::get('pembayaran/entripembayaran/{id_siswa}/getTagihan', 'PembayaranController@fetchTagihan')->name('fetch_tagihan');
    Route::get('pembayaran/entripembayaran/{id_tagihan}/getSisaTagihan', 'PembayaranController@fetchSisaTagihan')->name('fetch_sisa_tagihan');

});

Auth::routes();