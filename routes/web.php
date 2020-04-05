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

Route::get('/', 'HomeController@index')->name('home');

Route::get('pembayaran/cetak_pdf/{jenis_filter}/{periode}', 'PembayaranController@cetak_pdf')->name('cetak_laporan');

Route::get('ubahpassword', 'ProfilController@ubahpassword')->name('ubahpassword');
Route::get('ubahpassword/fetch/{old}', 'ProfilController@fetch_oldpassword')->name('ubahpassword_fetch');
Route::post('ubahpassword/store/{id}/{role}', 'ProfilController@ubahstore')->name('ubahpassword_store');

Route::get('profil/{slug}/{id}/{role_id}', 'ProfilController@index')->name('profile');
Route::post('profil/{slug}/{id}/{role_id}/perbaharui/store', 'ProfilController@update')->name('perbaharui_profile');

Route::get('data/siswa', 'SiswaController@index')->name('siswa');
Route::get('data/siswa/detail/{slug}/{id}', 'SiswaController@detail')->name('detail_siswa');
Route::get('data/siswa/tambah', 'SiswaController@tambah')->name('tambah_siswa');
Route::get('data/siswa/perbaharui/{slug}/{id}', 'SiswaController@showupdate')->name('perbaharui_siswa');
Route::post('data/siswa/tambah/store/{tipekelas_id}', 'SiswaController@store')->name('tambah_siswa_store');
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

Route::get('data/tagihan', 'TagihanController@index')->name('tagihan');
Route::get('data/tagihan/tambah', 'TagihanController@tambah')->name('tambah_tagihan');
Route::post('data/tagihan/tambah/store/{kelas_id}/{tipetagihan_id}', 'TagihanController@store')->name('tambah_tagihan_store');
Route::get('data/tagihan/perbaharui/{slug}', 'TagihanController@showupdate')->name('perbaharui_tagihan');
Route::post('data/tagihan/perbaharui/{slug}/store', 'TagihanController@update')->name('perbaharui_tagihan_store');
Route::post('data/tagihan/hapus/{id}', 'TagihanController@destroy')->name('hapus_tagihan_store');

Route::get('pembayaran/history', 'PembayaranController@history')->name('history');
Route::get('pembayaran/history/detail/{id}', 'PembayaranController@detail')->name('detail_history');
Route::get('pembayaran/entripembayaran', 'PembayaranController@index')->name('tambah_pembayaran');
Route::post('pembayaran/entripembayaran/store', 'PembayaranController@store')->name('tambah_pembayaran_store');
Route::get('pembayaran/entripembayaran/{id_kelas}/getsiswa', 'PembayaranController@fetch')->name('fetch_siswa');
Route::get('pembayaran/entripembayaran/{id_siswa}/getTagihan', 'PembayaranController@fetchTagihan')->name('fetch_tagihan');
Route::get('pembayaran/data', 'PembayaranController@data')->name('datapembayaran');

Auth::routes();