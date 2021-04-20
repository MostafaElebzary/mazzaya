<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ProfileController;
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

Route::group(['middleware' => 'Admin:admins'], function () {
    Route::get('/admin', function () {
        return view('Admin.index');
    });
    Route::get('/logout', function () {
        Auth::logout();
        return back();
    });

    Route::get('admin/profile', [ProfileController::class, 'profile']);
    Route::post('admin/profile', [ProfileController::class, 'updateProfile'])->name('profile.custom');


});
Route::group(['middleware'=>'guest'], function () {
    // Login Routes
    Route::get('admin/login', [LoginController::class, 'renderLogin']);
    Route::post('admin/login', [LoginController::class, 'login'])->name('login.custom');

    //---------------------------------------------------------------------------------------//
});

Route::get('lang/{lang}', function ($lang) {

    if (session()->has('lang')) {
        session()->forget('lang');
    }
    if ($lang == 'ar') {
        session()->put('lang', 'ar');
    } else {
        session()->put('lang', 'en');
    }


    return back();
});
