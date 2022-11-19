<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostManagementController as ApiPostManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\PostManagementController;
use App\Http\Controllers\Web\UserController as WebUserController;
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

// Route::get('/', function () {
//     return redirect(route('login'));
//     // return view('welcome');
// });
Route::get('auth/{selectedtab?}', [PostManagementController::class, 'landingPage'])->name('register');
Route::get('login', [PostManagementController::class, 'landingPage'])->name('login');
Route::post('login', [WebUserController::class, 'webClientEmailLogin'])->name('client.login.submit');
Route::post('signup', [WebUserController::class, 'webClientSignUp'])->name('client.registration');
Route::get('account_verification/{user}/{sendOtp?}', [WebUserController::class, 'webClientVerification'])->name('client.verification.screen');
Route::post('account_verification', [WebUserController::class, 'webClientOtpVerification'])->name('client.verification.submit');

Auth::routes(['login' => false]);


/*
|--------------------------------------------------------------------------
| Web Routes/users/events etc.....
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth:client'], 'as' => 'client.'], function() {
    Route::get('/', [PostManagementController::class, 'newsFeed'])->name('news.feed');
    Route::get('/home', [PostManagementController::class, 'newsFeed']);

    Route::post('/create_event', [PostManagementController::class, 'createNewEvent'])->name('create.new.event');

    Route::post('/follow_user', [PostManagementController::class, 'follow'])->name('follow.user');
    Route::post('web_like_post', [ApiPostManagementController::class, 'like'])->name('like.user.post');
    Route::post('web_dislike_post', [ApiPostManagementController::class, 'dislike'])->name('dislike.user.post');
});
// Route::post('/search_users', [LoginController::class, 'searchUserTagFriends'])->name('client.search.users');







/*
|--------------------------------------------------------------------------
| Admin Routes Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', [MainController::class, 'adminLogin']);
    Route::post('/login', [MainController::class, 'submitAdminLogin'])->name('submit.admin.login');
    Route::get('/', [MainController::class, 'adminLogin'])->name('admin.login');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

    Route::get('/user_apps', [HomeController::class, 'userAppList'])->name('user.apps.list');
    Route::get('/user_apps_detail/{id?}', [HomeController::class, 'showUserAppDetail'])->name('user.apps.deatil');
    Route::get('/events/{id?}', [HomeController::class, 'eventsList'])->name('user.apps.events.list');
    Route::get('/profile/{id?}', [HomeController::class, 'profile'])->name('admin.profile');

    Route::resource('users', UserController::class);
    // Route::resource('users','UserController');
});
