<?php

use App\Http\Controllers\Profile\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Livewire\Agent\Contacts;
use App\Http\Livewire\Agent\Activities;
use App\Http\Livewire\Agent\Notes;
use App\Http\Livewire\Agent\Alerts;
use App\Http\Livewire\Agent\Appointments;
use App\Http\Livewire\Agent\Conversion;
use App\Http\Livewire\Agent\Sales;

Route::group(['prefix' => 'profile'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('profile.login');
    Route::post('login', [LoginController::class, 'login'])->name('profile.login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('profile.logout');

    Route::group(['middleware' => ['auth:profile']], function () {
        Route::get('/', function () {
            return view('profiles.dashboard.index');
        })->name('profile.dashboard');
        Route::get('/contacts', Contacts::class)->name('profile.contacts');
        Route::get('/contacts/notes/{id}', Notes::class)->name('profile.contacts.notes');
        Route::get('/client/conversion', Conversion::class)->name('client.conversion');
        Route::get('/client/sales', Sales::class)->name('client.sales');
        Route::get('/client/appointments', Appointments::class)->name('client.appointments');
        Route::get('/client/alerts', Alerts::class)->name('client.alerts');
        Route::get('/activites', Activities::class)->name('profile.activities');
        Route::get('/settings', function () {
            return view('profiles.dashboard.settings');
        })->name('profile.settings');
    });
});
