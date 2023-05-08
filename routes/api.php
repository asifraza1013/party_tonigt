<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostManagementController;
use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\FriendsManagmentController;
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

    // web client APIs
    // Route::group([ 'middleware' => 'auth:client'], function () {
    //     Route::post('web_like_post', [PostManagementController::class, 'like'])->name('like.user.post');
    //     Route::post('web_dislike_post', [PostManagementController::class, 'dislike'])->name('dislike.user.post');
    // });

    Route::group([ 'middleware' => 'auth:sanctum'], function () {
        Route::post('cate_list', 'PostManagementController@cateList');
        Route::post('create_post', [PostManagementController::class, 'createPost']);
        Route::post('edit_post', [PostManagementController::class, 'editPost']);
        Route::post('post_list', [PostManagementController::class, 'allPosts']);
        Route::post('events_list', [PostManagementController::class, 'allEvents']);
        Route::post('my_posts', [PostManagementController::class, 'myposts']);
        Route::post('post_detail', [PostManagementController::class, 'postDetail']);
        Route::post('remove_post', [PostManagementController::class, 'destroy']);
        Route::post('like_post', [PostManagementController::class, 'like']);
        Route::post('dislike_post', [PostManagementController::class, 'dislike']);

        Route::post('upload_media', 'PostManagementController@uploadMedia');
        // Route::post('update_profile_image', 'LoginController@updateProfileImage');
        Route::post('update_profile_image', [LoginController::class, 'updateProfileImage']);
        Route::post('user_profile', [LoginController::class, 'userProfile']);
        Route::post('delete_account', [LoginController::class, 'deleteAccount']);
        Route::post('update_profile_info', [PostManagementController::class, 'updateProfileInfo']);

        Route::post('follow_user', [PostManagementController::class, 'follow']);
        Route::post('follower_list', [PostManagementController::class, 'followers']);
        Route::post('following_list', [PostManagementController::class, 'following']);
        Route::post('search_user', [PostManagementController::class, 'searchUser']);
        Route::post('search_user_by_ids', [PostManagementController::class, 'userByIds']);

        // Notifications section
        Route::post('notification_list', 'PostManagementController@getNotificationList');
        Route::post('read_single_noti', 'PostManagementController@markSingleAsRead');
        Route::post('read_all_noti', 'PostManagementController@markAllAsRead');

        // vote list section
        Route::post('vote_list', 'PostManagementController@voteList');
        Route::post('liked_post_list', [PostManagementController::class, 'postLikeList']);

        // report section
        Route::post('report_post', [PostManagementController::class, 'reportPost']);
        Route::post('report_reason_list', [PostManagementController::class, 'reportReasonList']);

        // block user section
        Route::post('block_user', [PostManagementController::class, 'blockUser']);
        Route::post('unblock_user', [PostManagementController::class, 'unblockUser']);
        Route::post('blocked_list', [PostManagementController::class, 'blockedUserList']);
        Route::post('buy_ticket', [PostManagementController::class, 'buyTicket']);

        // Notifications section
        Route::post('notification_list', [PostManagementController::class, 'getNotificationList']);
        Route::post('read_single_noti', [PostManagementController::class, 'markSingleAsRead']);
        Route::post('read_all_noti', [PostManagementController::class, 'markAllAsRead']);

        // Friends management section
        Route::group([ 'prefix' => 'friends'], function () {
            Route::post('send_request', [FriendsManagmentController::class, 'sendFriendRequest']);
            Route::post('frienship_status', [FriendsManagmentController::class, 'checkFriendshipStatus']);
            Route::post('frienship_request_status', [FriendsManagmentController::class, 'checkFriendRequestStatus']);
            Route::post('frienship_request_status_others', [FriendsManagmentController::class, 'checkFriendRequestStatusForOthers']);
            Route::post('accept_request', [FriendsManagmentController::class, 'acceptFriendRequest']);
            Route::post('reject_request', [FriendsManagmentController::class, 'rejectFriendRequest']);
            Route::post('unfriend', [FriendsManagmentController::class, 'unfriendUser']);
            Route::post('get_single_friendship', [FriendsManagmentController::class, 'getSingleFrienship']);
            Route::get('get_all_friendship', [FriendsManagmentController::class, 'getAllFrienship']);
            Route::get('get_pending_frienship', [FriendsManagmentController::class, 'getPendingFriendships']);
            Route::get('get_accepted_frienship', [FriendsManagmentController::class, 'getAcceptedFriendships']);
            Route::get('get_pending_friend_requests', [FriendsManagmentController::class, 'getFriendRequests']);
            Route::get('get_friends_count', [FriendsManagmentController::class, 'getFriendsCount']);
            Route::get('get_friends_list_details', [FriendsManagmentController::class, 'getFriends']);
        });
    });

});
