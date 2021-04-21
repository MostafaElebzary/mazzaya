<?php

use App\Http\Controllers\Admin\AdminsController;
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
    Route::get('admin/logout', function () {
        Auth::guard('admins')->logout();
        return back();
    });

    Route::get('admin/profile', [ProfileController::class, 'profile']);
    Route::post('admin/profile', [ProfileController::class, 'updateProfile'])->name('profile.custom');

    Route::get('admin/admins', [AdminsController::class, 'index']);
    Route::get('admin/admins/create', [AdminsController::class, 'create']);
    Route::post('admin/admins/store', [AdminsController::class, 'store']);
    Route::get('admin/admins/edit/{id}', [AdminsController::class, 'edit']);
    Route::post('admin/admins/update', [AdminsController::class, 'update']);
    Route::get('admin/admins/delete', [AdminsController::class, 'destroy']);


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
    if ($lang == 'en') {
        session()->put('lang', 'en');
    } else {
        session()->put('lang', 'ar');
    }


    return back();
});
