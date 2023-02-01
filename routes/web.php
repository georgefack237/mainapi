<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\SaveContact;
use App\Http\Livewire\Nfcprofile;
use App\Http\Livewire\Shownfc;
use App\Http\Livewire\ShowNfcLink;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmLawyerController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MailController;
use App\Http\Livewire\Activities;
use App\Http\Livewire\Admin\Clients;
use App\Http\Livewire\Commercial;
use App\Http\Livewire\Admin\Commercials;
use App\Http\Livewire\LawyersController;
use App\Http\Livewire\Contacts;
use App\Http\Livewire\Admin\Partners;
use App\Http\Livewire\Alerts;
use App\Http\Livewire\Appointments;
use App\Http\Livewire\Chats;
use App\Http\Livewire\Conversion;
use App\Http\Livewire\Mailing;
use App\Http\Livewire\Notes;
use App\Http\Livewire\Products;
use App\Http\Livewire\Prospection\Clients as ProspectionClients;
use App\Http\Livewire\Prospection\Leads;
use App\Http\Livewire\Prospection\Opportunities;
use App\Http\Livewire\Prospection\Prospects;
use App\Http\Livewire\Sales;
use App\Mail\Newsletter;

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

require 'admin.php';
require 'partner.php';
require 'profile.php';

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/nfc-clients/{slug}', ShowNfcLink::class)->name('nfc.link');
Route::post('/nfc-clients/save', [SaveContact::class, 'SaveContact'])->name('nfc.save');
Route::get('/nfc-clients/phonesave/{id}', [SaveContact::class, 'phoneSave'])->name('phoneSave');

Route::get('/msg', [SaveContact::class, 'sendMessage'])->name('msg');

Route::get('/admin/commercial/{slug}', Commercial::class)->name('commShow');
Route::get('/commercial/login', [CommercialController::class, 'Login'])->name('commLogin');
Route::post('/commercial/auth', [CommercialController::class, 'Auth'])->name('commAuth');

Route::get('/lawyers', LawyersController::class);
Route::get('/lawyers/add', [ConfirmLawyerController::class, 'addlawyer']);
Route::get('/lawyers/{slug}', [ConfirmLawyerController::class, 'showconfirm'])->name('showlawyer');
Route::get('/lawyers/save/{id}', [ConfirmLawyerController::class, 'save'])->name('lawyer.save');


// ADMIN ROUTES

Route::middleware('admin:admin')->group(function () {
    // Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
    // Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login.post');
    // Route::get('/admin/login', [AdminController::class, 'loginView']);
});

// Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified' ])->group(function () {
        // Route::get('/dashboard', function () {
            //     return view('dashboard');
            // })->name('dashboard');
    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard.index');
    //  })->name('admin.dashboard');

    // Route::get('/admin/partners', function () {
    //     return view('admin.partners');
    //  })->name('admin.partners');

    // Route::get('/admin/agents', function () {
    //     return view('admin.agents');
    //  })->name('admin.agents');

    // Route::get('/admin/clients', function () {
    //     return view('admin.clients');
    //  })->name('admin.clients');

    // Route::get('/admin/agents', Commercials::class)->name('admin.agents');
    // Route::get('/admin/clients', Clients::class)->name('admin.clients');
    // Route::get('/admin/nfcprofiles/{slug}', Shownfc::class)->name('nfc.show');
    // Route::post('/admin/contacts/batchsave', [SaveContact::class, 'saveContactBatch'])->name('batchSave');
// });

// ADMIN ROUTES

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {
        // Route::get('/dashboard', function () {
            //     return view('dashboard');
            // })->name('dashboard');
            Route::get('/dashboard',  [Dashboard::class, 'client'])->name('dashboard');
            Route::get('/client/nfcprofiles', Nfcprofile::class)->name('client.nfcprofiles');
            Route::get('/client/contacts', Contacts::class)->name('client.contacts');
            Route::get('/client/mailing', Mailing::class)->name('client.mailing');
            Route::get('/client/chats', Chats::class)->name('client.chats');
            Route::get('/client/mailing/send-mail', [MailController::class, 'sendMail'])->name('client.mail.send');
            Route::get('/client/conversion', Conversion::class)->name('client.rate.conversion');
            Route::get('/client/prospection/clients', ProspectionClients::class)->name('client.prospection.conversion');
            Route::get('/client/prospection/opportunities', Opportunities::class)->name('client.prospection.conversion');
            Route::get('/client/prospection/leads', Leads::class)->name('client.prospection.conversion');
            Route::get('/client/prospection/prospects', Prospects::class)->name('client.prospection.conversion');
            Route::get('/client/appointments', Appointments::class)->name('client.appointments');
            Route::get('/client/products', Products::class)->name('client.market.products');
            Route::get('/client/sales', Sales::class)->name('client.market.sales');
            Route::get('/client/alerts', Alerts::class)->name('client.alerts');
            Route::get('/client/activites', Activities::class)->name('client.activites');
            Route::get('/client/nfcprofiles/{slug}', Shownfc::class)->name('nfc.show');
            Route::post('/client/contacts/batchsave', [SaveContact::class, 'saveContactBatch'])->name('batchSave');
            Route::get('/client/get-events', [EventController::class, 'getEvents'])->name('get-events');
            Route::get('/client/mail-template', [MailController::class, 'sendMail']);
});
