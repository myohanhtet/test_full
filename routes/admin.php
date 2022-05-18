<?php


Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', [\App\Http\Controllers\Admin\LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login', [\App\Http\Controllers\Admin\LoginController::class,'login'])->name('admin.login.post');
    Route::get('logout', [\App\Http\Controllers\Admin\LoginController::class,'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

    });

});
