<?php

use App\Http\Controllers\LawyerApiController;
use App\Http\Controllers\NfcprofileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/users', [UserController::class, 'register']);
Route::get('/lawyers', [LawyerApiController::class, 'index']);
//Route::post('/lawyers', [LawyerApiController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/register_profile', [NfcProfileController::class, 'store']);
    Route::put('/register_profile/{id}', [NfcProfileController::class, 'update']);
});

