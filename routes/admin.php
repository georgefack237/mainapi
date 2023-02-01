<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Livewire\Admin\Client;
use App\Http\Livewire\Admin\ClientAgent;

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/dashboard',  [Dashboard::class, 'admin'])->name('admin.dashboard');

        Route::get('/partners', function () {
            return view('admin.partners');
         })->name('admin.partners');

        Route::get('/agents', function () {
            return view('admin.agents');
         })->name('admin.agents');

        Route::get('/clients', function () {
            return view('admin.clients');
         });

         Route::get('/client/{id}', Client::class)->name('admin.client');
         Route::get('/client/agent/{id}', ClientAgent::class)->name('admin.client.agent');
    });

 });
