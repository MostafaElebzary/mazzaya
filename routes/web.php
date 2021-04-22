<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\UsersController;
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

Route::group(['middleware' => 'Admin:admins', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('Admin.index');
    });
    Route::get('/logout', function () {
        Auth::guard('admins')->logout();
        return back();
    });

    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.custom');

//    admins
    Route::get('/admins', [AdminsController::class, 'index']);
    Route::get('/admins/create', [AdminsController::class, 'create']);
    Route::post('/admins/store', [AdminsController::class, 'store']);
    Route::get('/admins/edit/{id}', [AdminsController::class, 'edit']);
    Route::post('/admins/update', [AdminsController::class, 'update']);
    Route::get('/admins/delete', [AdminsController::class, 'destroy']);

//    users
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/users/update', [UsersController::class, 'update']);
    Route::get('/users/delete', [UsersController::class, 'destroy']);

});

Route::group(['middleware' => 'guest'], function () {
    // Login Routes
    Route::get('admin/login', [LoginController::class, 'renderLogin']);
    Route::post('admin/login', [LoginController::class, 'login'])->name('login.custom');

    //---------------------------------------------------------------------------------------//
});

Route::get('lang/{lang}', function ($lang) {

    if (session()->has('lang')) {
        session()->forget('lang');
    }
    if ($lang == 'en') {
        session()->put('lang', 'en');
    } else {
        session()->put('lang', 'ar');
    }


    return back();
});
