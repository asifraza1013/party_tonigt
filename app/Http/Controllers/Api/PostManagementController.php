<?php

namespace App\Http\Controllers\Api;

use App\Helpers\PostHelper;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostActivity;
use App\Models\Tag;
use App\Models\UserApp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PostManagementController extends Controller
{
    /**
     * category list
     */
    public function cateList()
    {
        return response()->json([
            'status' => true,
            'code' => 1000,
            'message' => 'Get Category List success',
            'data' => config('constants.post_categories_obj'),
        ]);
    }

    /**
     * create new post
     */
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'media' => 'nullable|array',
            // 'type' => 'required|string',
            // 'category' => 'required|string',
            // 'is_story' => 'nullable|string',
        ]);

        $profile = $request->user();

        // if request got tags
        if($request->tages){
            foreach($request->tages as $tag){
                Tag::updateOrCreate(
                    [
                        'name' => str_replace( array( '\'', '"',
                        ',' , ';', '<', '>', '#'), ' ', $tag),
                        'slug' => $tag
                    ],
                    [
                        'type' => 1
                    ]
                    );
            }
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_apps_id = $profile->id;
        $post->video_thumbnail_url = $request->video_thumbnail_url;
        $post->is_story = ($request->has('is_story') && $request->is_story) ? true : false;

        if(!empty($request->youtube_link)) $post->youtube_link = $request->youtube_link;
        if(!empty($request->background_link)) $post->background_link = $request->background_link;
        if($post->type) $post->type = $request->type;
        if(!empty($request->media)) $post->media_url = $request->media;
        if(!empty($request->category)) $post->category = $request->category;
        if(!empty($request->tags)) $post->tags = $request->tags;
        if(!empty($request->friends)) $post->friends = $request->friends;
        if(!empty($request->price)) $post->price = $request->price;
        if(!empty($request->total_tickets)) $post->total_tickets = $request->total_tickets;
        $post->save();

        return response()->json([
            'status' => true,
            'code' => 1001,
            'message' => 'Post created successfully',
            'data' => $post,
        ]);
    }

    /**
     * get all posts list
     */
    public function allPosts(Request $request)
    {
        $profile = $request->user();
        $limit = $request->limit ? $request->limit : config('constants.paginate_per_page');
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $skip = ($page - 1) * $limit;

        $countsQuery = [
            'post_activities as like_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as dislike_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as comment_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            },
            'post_activities as liked' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_LIKE'))->where('user_apps_id', $profile->id);
            },
            'post_activities as disliked' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'))->where('user_apps_id', $profile->id);
            },
            'post_activities as commented' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_COMMENT'))->where('user_apps_id', $profile->id);
            }
        ];

        $blockedUsers = $profile->followings()->where('is_blocked', true)->pluck('user_follower.following_id')->all();
        Log::info('BlockedUsers --'.json_encode($blockedUsers));
        if($request->has('following') && $request->following){
            $following = array_merge($profile->followings()->pluck('user_follower.id')->all(), [$profile->id]);
            $posts = Post::with(['user'])->where('status', 'Active')->whereNotIn('user_apps_id', $blockedUsers)->whereIn('user_apps_id', $following)->orderBy('created_at', 'desc');
        }else{
            $posts = Post::with(['user'])->where('status', 'Active')->whereNotIn('user_apps_id', $blockedUsers)->orderBy('created_at', 'desc');
        }
        if ($request->has('type') && $request->type) {
            $posts = $posts->where('type', $request->type)->orderBy('created_at', 'desc');
        }
        if ($request->user_id) {
            $posts = $posts->where('user_apps_id', $request->user_id)->orderBy('created_at', 'desc');
        }
        $posts = $posts->where('is_story', false);
        if ($request->is_story) {
            $posts->where('is_story', true);
        }
        $posts = $posts->withCount($countsQuery)->paginate(config('constants.paginate_per_page'));

        return response()->json([
            'status' =>  true,
            'code' =>  1002,
            'message' =>  'Get available post list success',
            'data' =>  $posts,
        ]);
    }

    /**
     * my post list
     */
    public function myposts(Request $request)
    {
        $profile = $request->user();
        $limit = $request->limit ? $request->limit : config('constants.paginate_per_page');
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $skip = ($page - 1) * $limit;
        $countsQuery = [
            'post_activities as like_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as dislike_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as comment_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            },
            'post_activities as liked' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as disliked' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as commented' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            }
        ];

        $posts = Post::where('user_apps_id', $profile->id)->where('status', 'Active')->where('is_story', false);

        if ($request->type) {
            $posts = $posts->where('type', $request->type);
        }
        if ($request->is_story) {
            $posts = $posts->where('is_story', true);
        }

        $posts = $posts->orderBy('created_at', 'desc')->withCount($countsQuery)->paginate(config('constants.paginate_per_page'));
        return response()->json([
            'status' => true,
            'code' => 1009,
            'message' => 'Get post list success',
            'data' => $posts
        ]);
    }

    /**
     * show post
     */
    public function postDetail(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|numeric|exists:posts,id',
        ]);
        $profile = $request->user();

        $countsQuery = [
            'post_activities as like_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as dislike_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as comment_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            },
            'post_activities as liked' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as disliked' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as commented' => function ($query) use ($profile) {
                $query->where('user_apps_id', $profile->id)
                    ->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            }
        ];
        $post = Post::where('id', $request->post_id)->where('is_story', false);
        if($request->is_story){
            $post = $post->where('is_story', true);
        }
        $post = $post->withCount($countsQuery)->first();
        return response()->json([
            'status' => true,
            'code' => 1003,
            'message' => 'Get Post detail success',
            'data' => $post,
        ]);
    }

    /**
     * remove post
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|string|exists:posts,id',
        ]);
        $post = Post::where('id', $request->post_id)->first();
        if(is_null($post))
        return response()->json([
            'status' => false,
            'message' => 'Sorry! post You are looking for not found.',
            'code' => 1004,
        ]);
        if($post->user_apps_id != $request->user()->id){
            return response()->json([
                'status' => false,
                'message' => 'Sorry! you are not authorized to remove this post.',
                'code' => 1004,
            ]);
        }
        $deleted = $post->delete();
        if($deleted){
            return response()->json([
                'status' => true,
                'code' => 1005,
                'message' => 'Post Removed successfully',
            ]);
        }
        return response()->json([
            'status' => false,
            'code' => 1006,
            'message' => 'Remove post failed. Please try again later.',
        ]);
    }

    /**
     * like post
     */
    public function like(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|numeric|exists:posts,id',
        ]);
        $profile = $request->user();
        $post = Post::where('id', $request->post_id)->first();
        $status = $this->likeDislikePost($post, config('constants.POST_ACTIVITY_LIKE'), $request->user());
        $user = UserApp::where('id', $post->user_apps_id)->first();
        if($status == 1){
            $detail = (object)[
                'detail' => $profile->user_name.' Like your post',
                'post_id' => $post->id,
                'post_name' => $post->title,
                'post_image' => $post->media_url,
                'liked_by' => $profile->user_name,
                'liked_by_image' => $profile->image,
                'type' => 1,
            ];
            // $user->notify(new InAppNotifications($user, $detail));
            return response()->json([
                'status' => true,
                'code' => 1007,
                'message' => 'Post liked successfully',
                'post' => $post
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 1007,
            'message' => 'Post unliked successfully',
            'post' => $post
        ]);
    }

    /**
     * like post
     */
    public function dislike(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|numeric|exists:posts,id',
        ]);
        $post = Post::where('id', $request->post_id)->first();
        $status = $this->likeDislikePost($post, config('constants.POST_ACTIVITY_DISLIKE'), $request->user());

        if($status == 1){
            return response()->json([
                'status' => true,
                'code' => 1008,
                'message' => 'Post disliked successfully',
                'post' => $post
            ]);
        }
        return response()->json([
            'status' => true,
            'code' => 1008,
            'message' => 'Post disliked removed successfully',
            'post' => $post
        ]);
    }


    private function likeDislikePost($post, $type, $profile)
    {
        $previousActivity = PostActivity::where('user_apps_id', $profile->id)
            ->where('post_id', $post->id)
            ->whereIn('type', array(config('constants.POST_ACTIVITY_LIKE'), config('constants.POST_ACTIVITY_DISLIKE')))
            ->first();

        if ($previousActivity) {
            $previousActivity->delete();

            if ($previousActivity->type == $type) {
                return -1; // unlike or undislike
            }
        }

        PostHelper::createPostActivity($profile, $post, $type);
        return 1; // like or dislike
    }

    /**
     * follow user
     */
    public function follow(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric|exists:user_apps,id',
        ]);
        $success = 0; // no action
        $userProfile = UserApp::where('id', $request->user_id)->first();
        if(!$userProfile){
            return response()->json([
                'status' => false,
                'code' => 1010,
                'message' => 'Sorry! Can\'t find user. Please with correct data'
            ]);
        }
        $currentProfile = $request->user();
        if ($currentProfile->isFollowing($userProfile)) {
            $currentProfile->unfollow($userProfile);
            $success = 1; // unfollow
        } else {
            $currentProfile->follow($userProfile);
            $success = 2; // follow
            Log::info('unfollow-- ');
            $detail = (object)[
                'is_follow' => true,
                'type' => 3,
                'detail' => $userProfile->user_name.' Started Following You',
                'user_id' => $currentProfile->id,
                'user_name' => $currentProfile->user_name,
                'user_image' => $currentProfile->image,
            ];
            Log::info('unfollow 2-- ');
            // $userProfile->notify(new InAppNotifications($userProfile, $detail));
        }
        return response()->json([
            'status' => true,
            'code' => 1011,
            'message' =>  ($success == 1) ? 'Unfollow user success' : 'Follow user success'
        ]);
    }

     /**
     * followers list
     */
    public function followers(Request $request)
    {
        $userProfile = $request->user();
        // $followerList = $userProfile->followers()->paginate(config('constants.paginate_per_page'));
        if($request->has('user_id') && $request->user_id){
            $otherUser = UserApp::where('id', $request->user_id)->first();
            if(empty($otherUser)){
                return response()->json([
                    'status' => false,
                    'code' => 2001,
                    'message' => 'Profile not found for requested user. Please try with correct data'
                ]);
            }
            $list =  $otherUser->followers()->get();

            // check if current user is fowllowing from list
            $followerList = [];
            foreach($list as $key=>$flw){
            //    $status = $userProfile->isFollowedBy($flw);
               $status = $userProfile->isFollowing($flw);
               $flw->has_following = $status;
               array_push($followerList, $flw);
            }
        }else{
            $list = $userProfile->followings()->get();
            // check if current user is fowllowing from list
            $followerList = [];
            foreach($list as $key=>$flw){
            //    $status = $userProfile->isFollowedBy($flw);
               $status = $userProfile->isFollowing($flw);
               $flw->has_following = $status;
               array_push($followerList, $flw);
            }
        }

        return response()->json([
            'status' => true,
            'code' => 1012,
            'message' => 'Get followers list success',
            'data' => $followerList
        ]);
    }

    /**
     * following user
     */
    public function following(Request $request)
    {
        $userProfile = $request->user();
        if($request->has('user_id') && $request->user_id){
            $otherUser = UserApp::where('id', $request->user_id)->first();
            if(empty($otherUser)){
                return response()->json([
                    'status' => false,
                    'code' => 2001,
                    'message' => 'Profile not found for requested user. Please try with correct data'
                ]);
            }
            $list =  $otherUser->followers()->get();

            // check if current user is fowllowing from list
            $followerList = [];
            foreach($list as $key=>$flw){
               $status = $userProfile->isFollowing($flw);
               $flw->has_following = $status;
               array_push($followerList, $flw);
            }
        }else{
            $followerList = $userProfile->followers()->get();
        }
        return response()->json([
            'status' => true,
            'code' => 1013,
            'message' => 'Get following list success',
            'data' => $userProfile->followings()->paginate(config('constants.paginate_per_page'))
        ]);
    }

    /**
     * search users
     */
    public function searchUser(Request $request)
    {
        $search = $request->user_name;
        $profiles = UserApp::where('user_name', 'like', '%' . $search . '%')
        ->orWhere('first_name', 'like', '%' . $search . '%')
        ->orWhere('last_name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
        ->withCount(['followings', 'followers'])->paginate(config('constants.paginate_per_page'));
        return response()->json($profiles);
    }

    /**
     * upload media
     */
    public function uploadMedia(Request $request)
    {
        $this->validate($request, [
            'media' => 'required|string',
        ]);

        $image = $request->media;  // your base64 encoded
        $image = str_replace(' ', '+', $image);
        if($request->has('is_video') && $request->is_video){
            $imageName = Str::random(10).'.mp4';
        }else{
            $imageName = Str::random(10).'.png';
        }
        File::put(public_path('uploads/'.$imageName), base64_decode($image));

        return response()->json([
            'status' => true,
            'message' => 'Media uploaded successfully',
            'code' => 2000,
            'url' => asset('uploads/'.$imageName)
        ]);
    }

    /**
     * get notification list
     */
    public function getNotificationList(Request $request)
    {
        $user = $request->user();
        $notifications = DB::table('notifications')->where('notifiable_id', $user->id)->get();
        $data = [];

        foreach($notifications as $key=>$noti){
            $decoded = json_decode($noti->data);
            if($decoded->type != 3){
                $detail = (object)[
                    'id' => $noti->id,
                    'is_follow' => false,
                    'type' => $decoded->type,
                    'user_id' => $noti->notifiable_id,
                    'post_id' => $decoded->post_id,
                    'read_at' => $noti->read_at,
                    'user_name' => $decoded->name,
                    'user_email' => $decoded->email,
                    'notification' => $decoded->notification,
                    'extra_detail' => (object)[
                        'post_name' => $decoded->post_name,
                        'post_image' => $decoded->post_image,
                        'liked_by' => $decoded->liked_by,
                        'liked_by_image' => $decoded->liked_by_image,
                    ],
                ];
            }else{
                $detail = (object)[
                    'id' => $noti->id,
                    'is_follow' => true,
                    'type' => $decoded->type,
                    'user_id' => $noti->notifiable_id,
                    'read_at' => $noti->read_at,
                    'user_name' => $decoded->name,
                    'user_email' => $decoded->email,
                    'notification' => $decoded->notification,
                    'extra_detail' => (object)[
                        'f_user_id' => (isset($decoded->f_user_id)) ?  $decoded->f_user_id : $decoded->user_id,
                        'user_name' => $decoded->user_name,
                        'user_image' => $decoded->user_image,
                    ],
                ];
            }
            array_push($data, $detail);
        }
        return response()->json([
            'status' => true,
            'code' => 2002,
            'message' => 'Get notification list success',
            'notifications' => $data
         ]);
    }

    /**
     * mark single as read notification
     */
    public function markSingleAsRead(Request $request)
    {
        $this->validate($request, [
            'notification_id' => 'required|string',
        ]);

        DB::table('notifications')->where('id', $request->notification_id)->update([
            'read_at' => date('Y-m-d h:i:s')
        ]);
        return response()->json([
            'status'=> true,
            'code' => 2003,
            'message' => 'Notification marked as read successfully'
        ]);
    }

    /**
     * mark all as read
     */
    public function markAllAsRead(Request $request){
        DB::table('notifications')->where('read_at', null)->update([
            'read_at' => date('Y-m-d h:i:s')
        ]);
        return response()->json([
            'status'=> true,
            'code' => 2003,
            'message' => 'Notification marked as read successfully'
        ]);
    }

    /**
     * vote list
     */
    public function voteList(Request $request)
    {
        $user = $request->user();
        // if($request->has('user_id') && $request->user_id){
        //     $ids = DB::table('post_activities')->where('type', config('constants.POST_ACTIVITY_LIKE'))->pluck('user_apps_id')->all();
        // }else{
        // }
        $userId = $user->id;
        if($request->has('user_id') && $request->user_id){
            $userId = $request->user_id;
            $user = UserApp::where('id', $userId)->first();
            if(!$user){
                return response()->json([
                    'status' => false,
                    'code' => 5001,
                    'message' => 'Given userid is not valid.',
                ]);
            }
        }
        // get user post ids
        $postIds = Post::where('user_apps_id', $userId)->pluck('id');
        $ids = DB::table('post_activities')
        ->whereIn('post_id', $postIds)
        ->where('type', config('constants.POST_ACTIVITY_LIKE'))
        ->where('deleted_at', null)
        ->pluck('user_apps_id')->all();
        $usres = UserApp::whereIn('id', $ids)->distinct()->get();

        $followerList = [];
        foreach($usres as $key=>$flw){
           $status = $user->isFollowing($flw);
           $flw->has_following = $status;
           array_push($followerList, $flw);
        }
        return response()->json([
            'status' => true,
            'code' => 2004,
            'message' => 'Get vote list success.',
            'data' => $usres
        ]);
    }

    /**
     * get post like list
     */
    public function postLikeList(Request $request)
    {
        // $this->validate($request, [
        //     'post_id' => 'required|numeric',
        // ]);
        $userId = null;
        $profile = $request->user();
        if($request->has('user_id') && $request->user_id){
            $userId = $request->user_id;
        }else{
            $userId = $profile->id;
        }
        $ids = DB::table('post_activities')->where('type', config('constants.POST_ACTIVITY_LIKE'))->where('user_apps_id', $userId)->pluck('post_id')->all();
        $limit = $request->limit ? $request->limit : config('constants.paginate_per_page');
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $skip = ($page - 1) * $limit;

        $countsQuery = [
            'post_activities as like_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_LIKE'));
            },
            'post_activities as dislike_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'));
            },
            'post_activities as comment_count' => function ($query) {
                $query->where('type', config('constants.POST_ACTIVITY_COMMENT'));
            },
            'post_activities as liked' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_LIKE'))->where('user_apps_id', $profile->id);
            },
            'post_activities as disliked' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_DISLIKE'))->where('user_apps_id', $profile->id);
            },
            'post_activities as commented' => function ($query) use ($profile) {
                    $query->where('type', config('constants.POST_ACTIVITY_COMMENT'))->where('user_apps_id', $profile->id);
            }
        ];

        $posts = Post::with(['user'])->whereIn('id', $ids)->orderBy('created_at', 'desc');
        // if ($request->has('type') && $request->type) {
        //     $posts = $posts->where('type', $request->type)->orderBy('created_at', 'desc');
        // }
        // if ($request->user_id) {
        //     $posts = $posts->where('user_apps_id', $request->user_id)->orderBy('created_at', 'desc');
        // }
        $posts = $posts->where('is_story', false)
        ->where('status', 'Active')
        ->withCount($countsQuery)->paginate(config('constants.paginate_per_page'));

        return response()->json([
            'status' => true,
            'code' => 2005,
            'message' => 'Get post like list success.',
            'data' => $posts
        ]);
    }

    /**
     * update user profile info
     */
    public function updateProfileInfo(Request $request)
    {
        // $this->validate($request, [
        //     'first_name' => 'required|string',
        //     'last_name' => 'required|string',
        //     // 'user_name' => 'required|string',
        //     'country' => 'required|string',
        //     'dob' => 'required|string',
        //     'gender' => 'required|string',
        //     'phone' => 'required|string',
        //     'image' => 'nullable|string',
        // ]);
        $user = $request->user();
        $user->country = $request->country;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        if($request->has('first_name') && $request->first_name){
            $user->first_name = $request->first_name;
        }
        if($request->has('last_name') && $request->last_name){
            $user->last_name = $request->last_name;
        }
        if($request->has('country') && $request->country){
            $user->country = $request->country;
        }
        if($request->has('dob') && $request->dob){
            $user->dob = $request->dob;
        }
        if($request->has('gender') && $request->gender){
            $user->gender = $request->gender;
        }
        if($request->has('phone') && $request->phone){
            $user->phone = $request->phone;
        }
        if($request->has('image') && $request->image){
            $user->image = $request->image;
        }

        $user->update();
        return response()->json([
            'status' => true,
            'code' => 2006,
            'message' => 'Update user profile success',
        ]);
    }

    /**
     * report a post
     */
    public function reportPost(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|numeric',
            'reason' => 'required|numeric',
        ]);

        $rport = new Report();
        $rport->reason = config('constants.report_reasons.'.$request->reason);
        $rport->report_for = $request->post_id;
        $rport->report_for = $request->post_id;
        $rport->type = config('constants.report_type.post');
        $rport->save();
        return response()->json([
            'status' => true,
            'code' => 2010,
            'message' => 'Post reported successfully'
        ]);
    }

    /**
     * report reasons list
     */
    public function reportReasonList(Request $request)
    {
        return response()->json([
            'status' => true,
            'code' => 2011,
            'message' => 'Report reason list success',
            'list' => config('constants.report_reasons')
        ]);
    }

    /**
     * block user
     */
    public function blockUser(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
        ]);

        $user = $request->user();
        // check if user is not blocked.
        // $exist = DB::table('user_follower')->where('following_id', $user->id)
        // ->where('follower_id', $request->user_id)->update([
        //     'is_blocked' => true,
        // ]);
        // DB::table('user_follower')->updateOrInsert(
        //     ['following_id' => $user->id, 'follower_id' => $request->user_id],
        //     ['following_id' => $user->id, 'follower_id' => $request->user_id, 'is_blocked' => true, 'created_at' => date('Y-m-d h:s:i'), 'updated_at' => date('Y-m-d h:s:i')],
        // );
        $follower = DB::table('user_follower')->where('follower_id', $user->id)->where('following_id', $request->user_id)->first();
        if(is_null($follower)){
            DB::table('user_follower')->insert([
                'follower_id' => $user->id,
                'following_id' => $request->user_id,
                'is_blocked' => true,
                'only_block' => true,
                'created_at' => date('Y-m-d h:s:i'),
                'updated_at' => date('Y-m-d h:s:i'),
            ]);
        }else{
            DB::table('user_follower')->where('follower_id', $user->id)->where('following_id', $request->user_id)->update(['is_blocked' => true]);
        }
        return response()->json([
            'status' => true,
            'code' => 2012,
            'message' => 'User blocked successfully'
        ]);
    }

    /**
     * unblock user
     */
    public function unblockUser(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
        ]);

        $user = $request->user();

        // check if user is not blocked.
        $follower = UserFollower::where('follower_id', $user->id)->where('following_id', $request->user_id)->first();
        if(is_null($follower)){
            return response()->json([
                'status' => false,
                'code' => 2014,
                'message' => 'Record Not found to unblock'
            ]);
        }else{
            if($follower->only_block){
                $follower->delete();
            }else{
                $follower->is_blocked = false;
                $follower->update();
            }
        }
        // $exist = DB::table('user_follower')->where('following_id', $user->id)
        // ->where('follower_id', $request->user_id)->update([
        //     'is_blocked' => false,
        // ]);
        return response()->json([
            'status' => false,
            'code' => 2013,
            'message' => 'User unblocked successfully'
        ]);
    }

    /**
     * blocked user list
     */
    public function blockedUserList(Request $request)
    {
        $user = $request->user();
        $ids = DB::table('user_follower')
        ->where('follower_id', $user->id)
        ->where('is_blocked', true)
        ->pluck('following_id')
        ->all();
        if(empty($ids)){
            return response()->json([
                'status' => false,
                'code' => 2015,
                'message' => 'No Blocked user found.'
            ]);
        }
        $users = UserApp::whereIn('id', $ids)->get();
        return response()->json([
            'status' => false,
            'code' => 2014,
            'message' => 'blocked user list successful',
            'list' => $users
        ]);
    }
}