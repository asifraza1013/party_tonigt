<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return redirect(route('login'));
    // return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

    Route::get('/user_apps', [HomeController::class, 'userAppList'])->name('user.apps.list');
    Route::get('/user_apps_detail/{id?}', [HomeController::class, 'showUserAppDetail'])->name('user.apps.deatil');
    Route::get('/events/{id?}', [HomeController::class, 'eventsList'])->name('user.apps.events.list');
    Route::get('/profile/{id?}', [HomeController::class, 'profile'])->name('admin.profile');

    Route::resource('users', UserController::class);
    // Route::resource('users','UserController');
});
