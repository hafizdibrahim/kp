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
    return redirect('/login');
});

Route::get('layouts/layout', 'AdminController@layout'); 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('users', 'GuruController@index');

Route::get('users-list', 'GuruController@usersList'); 


Route::group(['middleware' => 'auth'], function(){

// Admin Controller
Route::get('/dashboard_admin', 'AdminController@dashboard_admin')->name('dashboard_admin');
Route::get('/banyak_siswa', 'AdminController@banyak_siswa');
Route::get('/siswa_sp3', 'DashboardAdminController@siswa_sp3');
Route::get('/siswa_sp2', 'DashboardAdminController@siswa_sp2');
Route::get('/siswa_sp1', 'DashboardAdminController@siswa_sp1');
Route::get('/siswa_r1', 'DashboardAdminController@siswa_r1');
Route::get('/siswa_r2', 'DashboardAdminController@siswa_r2');
Route::get('/siswa_r3', 'DashboardAdminController@siswa_r3');
// Akhir Admin Controller

// Siswa Controller
Route::get('/dashboard_siswa', 'SiswaController@dashboard_siswa')->name('dashboard_siswa');
Route::get('/siswa_punishment', 'SiswaController@siswa_punishment');
Route::get('/siswa_reward', 'SiswaController@siswa_reward');
// Akhir Siswa Controller

// Guru Controller
Route::Get('/dashboard_guru', 'GuruController@dashboard_guru')->name('dashboard_guru');
Route::post('/reward/murid/store', 'GuruController@reward_murid_store');
Route::post('/punishment/murid/store', 'GuruController@punishment_murid_store');
Route::get('/history_memberi_punishment', 'GuruController@history_memberi_punishment');
Route::get('/history_memberi_reward', 'GuruController@history_memberi_reward');
Route::get('/filter_reward', 'GuruController@filter_reward');
Route::get('/filter_punishment', 'GuruController@filter_punishment');
Route::get('/cari_history_reward', 'GuruController@cari_history_reward');
Route::get('/guru_hapus_punishment/{id_kebijakan_punishment}', 'GuruController@guru_hapus_punishment');
Route::get('/guru_hapus_reward/{id_kebijakan_reward}', 'GuruController@guru_hapus_reward');

// Akhir Guru Controller

// Rombel Controller
Route::get('/rombel', 'AdminController@rombel')->name('rombel');
Route::get('/rombel/hapus/{id_rombel}', 'AdminController@rombel_hapus');
Route::get('/rombel/detail/{id_rombel}', 'AdminController@rombel_detail');
Route::get('/rombel/edit/{id_rombel}', 'AdminController@rombel_edit');
Route::post('/rombel/store', 'AdminController@rombel_store');
Route::post('/rombel/update', 'AdminController@rombel_update');
Route::post('/pindahkan/rombel', 'AdminController@pindahkan_rombel');
// Akhir Rombel Controller


// Rayon Controller
Route::get('/rayon', 'AdminController@rayon');
Route::get('/rayon/hapus/{id_rayon}', 'AdminController@rayon_hapus');
Route::get('/rayon/edit/{id_rayon}', 'AdminController@rayon_edit');
Route::post('/rayon/store', 'AdminController@rayon_store');
Route::post('/rayon/update', 'AdminController@rayon_update');
// Akhir Rayon Controller


// mapel Controller
Route::get('/mapel', 'AdminController@mapel');
Route::get('/mapel/hapus/{id_mapel}', 'AdminController@mapel_hapus');
Route::get('/mapel/edit/{id_mapel}', 'AdminController@mapel_edit');
Route::post('/mapel/store', 'AdminController@mapel_store');
Route::post('/mapel/update', 'AdminController@mapel_update');
// Akhir Jurusan Controller

// Jurusan Controller
Route::get('/jurusan', 'AdminController@jurusan');
Route::get('/jurusan/hapus/{id_jurusan}', 'AdminController@jurusan_hapus');
Route::get('/jurusan/edit/{id_jurusan}', 'AdminController@jurusan_edit');
Route::post('/jurusan/store', 'AdminController@jurusan_store');
Route::post('/jurusan/update', 'AdminController@jurusan_update');
// Akhir Jurusan Controller


// Reward Controller
Route::get('/reward', 'AdminController@reward');
Route::get('/reward/hapus/{id_reward}', 'AdminController@reward_hapus');
Route::get('/reward/edit/{id_reward}', 'AdminController@reward_edit');
Route::post('/reward/store', 'AdminController@reward_store');
Route::post('/reward/update', 'AdminController@reward_update');
// Akhir Reward Controller

// Punishment Controller
Route::get('/punishment', 'AdminController@punishment');
Route::get('/punishment/hapus/{id_punishment}', 'AdminController@punishment_hapus');
Route::get('/punishment/edit/{id_punishment}', 'AdminController@punishment_edit');
Route::post('/punishment/store', 'AdminController@punishment_store');
Route::post('/punishment/update', 'AdminController@punishment_update');
// Akhir Punishment Controller
});

// Data Users
Route::get('/guru', 'AdminController@guru');
Route::get('/detail_guru/{id_guru}', 'AdminController@detail_guru');
Route::post('/guru_update', 'AdminController@guru_update');
Route::post('/tambah_guru', 'AdminController@tambah_guru_store');
Route::get('/admin', 'AdminController@admin');
Route::get('/detail_admin/{id}', 'AdminController@detail_admin');
Route::post('/admin_update', 'AdminController@admin_update');
Route::post('/tambah_admin', 'AdminController@tambah_admin_store');
Route::get('/detail_admin/{id}', 'AdminController@detail_admin');
Route::get('/siswa', 'AdminController@siswa');
Route::get('/detail_siswa/{id}', 'AdminController@detail_siswa');
Route::post('/tambah_siswa', 'AdminController@tambah_siswa');
Route::post('/siswa_update', 'AdminController@siswa_update');
// Akhir Data Users

// Dashboard Admin
Route::get('/banyak_siswa', 'DashboardAdminController@banyak_siswa');
Route::get('/punishment/hapus/{id_punishment}', 'DashboardAdminController@punishment_hapus');
Route::get('/punishment/edit/{id_punishment}', 'DashboardAdminController@punishment_edit');
Route::post('/punishment/store', 'DashboardAdminController@punishment_store');
Route::post('/punishment/update', 'DashboardAdminController@punishment_update');
// Akhir Dashboard Admin

