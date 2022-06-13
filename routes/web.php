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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/calonPaskibraka/register', 'CalonPendampingController@daftar')->name('calonPaskibraka.daftar');
Route::post('/calonPaskibraka/register', 'CalonPaskibrakaController@kirim')->name('calonPaskibraka.kirim');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('calonPaskibraka', 'CalonPaskibrakaController');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin','middleware' => 'can:admin'], function()
    {
        Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');
        Route::get('users', 'UserController@index')->name('admin.users');
        Route::get('users/{id}', 'UserController@show')->name('admin.password');
        Route::get('paskibrakas', 'CalonPaskibrakaController@list')->name('admin.paskibrakas');
        Route::get('paskibrakas/{id}', 'CalonPaskibrakaController@show')->name('admin.paskibraka.show');
        Route::post('paskibrakas/{id}', 'CalonPaskibrakaController@validasi')->name('admin.paskibraka.validasi');
        Route::post('paskibrakas/delete/{id}', 'CalonPaskibrakaController@destroy')->name('admin.paskibraka.destroy');
        Route::get('paskibrakas/kabarin/{id}/{kabar}', 'CalonPendampingController@kabarin')->name('admin.pendamping.kabarin');
        Route::post('users/delete/{id}', 'UserController@destroy')->name('admin.user.destroy');
        Route::post('paskibrakas', 'CalonPaskibrakaController@store')->name('admin.hasil');
        Route::get('kriterias', 'KriteriaController@index')->name('admin.kriterias');
        Route::get('electres', 'HomeController@electres')->name('admin.electres');
        Route::post('gantiPassword/{id}', 'UserController@ganti')->name('admin.ganti');

        // Laporan
        Route::get('/laporan/ranking','LaporanController@laporanRanking')->name('laporan.ranking');
        Route::get('/laporan/pendamping/{id}/{rank}','LaporanController@laporanPendamping')->name('laporan.pendamping');
    });
    
    Route::group(['prefix' => 'pendamping','middleware' => 'can:pendamping'], function()
    {
        Route::get('dashboard', 'CalonPendampingController@index')->name('pendamping.dashboard');
        Route::get('profile', 'CalonPendampingController@profile')->name('pendamping.profile');
        Route::get('gantiPassword', 'CalonPendampingController@gantiPassword')->name('pendamping.gantiPassword');
        Route::post('gantiPassword', 'CalonPendampingController@ganti')->name('pendamping.ganti');
        Route::post('profile/{id}', 'CalonPendampingController@udpdate')->name('pendamping.update');
    }); 
});
