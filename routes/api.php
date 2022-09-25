<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\ApiLoginController;
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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/signup', [LoginController::class, 'userSignUp']);
    Route::post('/send_otp', [LoginController::class, 'sendOtp']);
    Route::post('/verif_otp', [LoginController::class, 'verifyOtp']);
    Route::post('/login', [LoginController::class, 'customerEmailLogin']);
    Route::post('/reset_password', [LoginController::class, 'updatePassword']);

});
