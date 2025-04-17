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
    return view('auth.login');
});

Auth::routes();

// semua route admin dibawah ini
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');

    Route::get('/request', 'Admin\RequestController@index')->name('admin.request');
    Route::post('/request/{id}/approve', 'Admin\RequestController@approve')->name('admin.approve');
    Route::post('/request/{id}/reject', 'Admin\RequestController@reject')->name('admin.reject');
    Route::get('/history', 'Admin\HistoryController@index')->name('admin.history');

    // Route::get('/user-list', 'Admin\UserController@index')->name('admin.user');
    // Route::post('/user-list/create', 'Admin\UserController@store')->name('admin.create');
    // Route::post('/user-list/{id}/delete', 'Admin\UserController@destroy')->name('admin.delete');

    Route::resource('user', 'Admin\UserController');

});

// semua route user dibawah ini
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user'], function () {
    Route::get('/home', 'User\HomeController@index' )->name('user.home');

    Route::get('/rooms/{id}', 'User\RoomController@show')->name('user.rooms.detail');
    Route::post('/rooms/{id}/book', 'User\RoomController@book')->name('user.rooms.book');
    Route::get('/history', 'User\HistoryController@index')->name('user.history');
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    if(Auth::user()->role == 'admin') {
        return redirect()->route('admin.home');
    } else {
        return redirect()->route('user.home');
    }
})->middleware(['auth'])->name('home');
