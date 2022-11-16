<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostManagementController;
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

Route::get('/search_users', [LoginController::class, 'searchUserTagFriends'])->name('client.search.users');
Route::get('/search_tags', [LoginController::class, 'saerchTags'])->name('client.search.tags');
Route::group(['namespace' => 'Api'], function () {
    Route::post('/signup', [LoginController::class, 'userSignUp']);
    Route::post('/send_otp', [LoginController::class, 'sendOtp']);
    Route::post('/verif_otp', [LoginController::class, 'verifyOtp']);
    Route::post('/login', [LoginController::class, 'customerEmailLogin']);
    Route::post('/reset_password', [LoginController::class, 'updatePassword']);

});

Route::group(['namespace' => 'Api'], function () {
    Route::group([ 'middleware' => 'auth:sanctum'], function () {
        Route::post('cate_list', 'PostManagementController@cateList');
        Route::post('create_post', [PostManagementController::class, 'createPost']);
        Route::post('post_list', [PostManagementController::class, 'allPosts']);
        Route::post('my_posts', [PostManagementController::class, 'myposts']);
        Route::post('post_detail', [PostManagementController::class, 'postDetail']);
        Route::post('remove_post', [PostManagementController::class, 'destroy']);
        Route::post('like_post', [PostManagementController::class, 'like']);
        Route::post('dislike_post', [PostManagementController::class, 'dislike']);

        Route::post('upload_media', 'PostManagementController@uploadMedia');
        Route::post('update_profile_image', 'LoginController@updateProfileImage');
        // Route::post('user_profile', 'LoginController@userProfile');
        Route::post('update_profile_info', 'PostManagementController@updateProfileInfo');

        Route::post('follow_user', [PostManagementController::class, 'follow']);
        Route::post('follower_list', [PostManagementController::class, 'followers']);
        Route::post('following_list', [PostManagementController::class, 'following']);
        Route::post('search_user', [PostManagementController::class, 'searchUser']);

        // Notifications section
        Route::post('notification_list', 'PostManagementController@getNotificationList');
        Route::post('read_single_noti', 'PostManagementController@markSingleAsRead');
        Route::post('read_all_noti', 'PostManagementController@markAllAsRead');

        // vote list section
        Route::post('vote_list', 'PostManagementController@voteList');
        Route::post('liked_post_list', [PostManagementController::class, 'postLikeList']);

        // report section
        Route::post('report_post', 'PostManagementController@reportPost');
        Route::post('report_reason_list', 'PostManagementController@reportReasonList');

        // block user section
        Route::post('block_user', [PostManagementController::class, 'blockUser']);
        Route::post('unblock_user', [PostManagementController::class, 'unblockUser']);
        Route::post('blocked_list', [PostManagementController::class, 'blockedUserList']);
    });

});
