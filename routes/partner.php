<?php

use App\Http\Controllers\Partner\LoginController;

Route::group(['prefix' => 'partner'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('partner.login');
    Route::post('login', [LoginController::class, 'login'])->name('partner.login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('partner.logout');

    Route::group(['middleware' => ['auth:partner']], function () {
        Route::get('/', function () {
           return view('partner.dashboard.index');
        })->name('partner.dashboard');

        Route::get('/clients', function () {
           return view('partner.clients');
        })->name('partner.clients');
    });

 });
