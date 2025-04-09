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
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

});

// semua route user dibawah ini
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user'], function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    if(Auth::user()->role == 'admin') {
        return redirect()->route('admin.home');
    } else {
        return redirect()->route('user.home');
    }
})->middleware(['auth'])->name('home');
