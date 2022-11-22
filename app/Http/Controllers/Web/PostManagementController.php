<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostManagementController extends Controller
{
    public function landingPage(Request $request)
    {
        $title = 'Landing Page';
        $noFooter = true;
        $selectedTab = ($request->filter) ? $request->filter : 'login';
        return view('frontend.auth.index', compact([
            'noFooter',
            'selectedTab',
            'title',
        ]));
    }

    public function newsFeed(Request $request)
    {
        $title = 'News Feed Page';
        $user = Auth::user();
        $user->following_count = $user->followings()->count();
        $user->followers_count = $user->followers()->count();

        // get suggested people
        $following = array_merge($user->followings()->pluck('user_follower.following_id')->all());
        array_push($following, $user->id);

        // TODO: get most followed poeople as suggestion
        $suggestedUsers = UserApp::whereNotIn('id', $following)->where('status', 1)->inRandomOrder()->limit(10)->get();
        $posts = $this->getAllPost($request);

        return view('frontend.landing_page', compact([
            'posts',
            'suggestedUsers',
            'title',
            'user',
        ]));
    }


    public function createNewEvent(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            // 'ticket_price' => 'required_if:ticket_detail,==,on|numeric',
            // 'total_tickets' => 'required_if:ticket_detail,==,on|numeric',
            'images' => 'required|array',
            'images.*' => 'required|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = error_msg_serialize($validator->errors());

        if (count($errors) > 0)
        {
            return redirect()->back()->with('error', $errors);
        }
        $imageUrls = [];
        foreach($request->images as $key=>$image){
           $imageUrl =  uploadImage($image);
           array_push($imageUrls, $imageUrl);
        }

        $profile = $request->user();

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_apps_id = $profile->id;
        $post->video_thumbnail_url = $request->video_thumbnail_url;
        $post->is_story = ($request->has('is_story') && $request->is_story) ? true : false;

        if(!empty($request->youtube_link)) $post->youtube_link = $request->youtube_link;
        if(!empty($request->background_link)) $post->background_link = $request->background_link;
        if($post->type) $post->type = $request->type;
        $post->media_url = $imageUrls;
        if(!empty($request->category)) $post->category = $request->category;
        if(!empty($request->tags)) $post->post_tags = $request->tags;
        if(!empty($request->friends)) $post->friends = $request->friends;
        if(!empty($request->ticket_price)) $post->price = $request->ticket_price;
        if(!empty($request->total_tickets)) $post->total_tickets = $request->total_tickets;

        if($request->ticket_detail == 'on') $post->is_event = true;
        $post->save();
        if(!empty($request->tags)) $post->attachTags($request->tags);
        return redirect()->back()->with('success', 'New Event created successfully.');
    }


    public function follow(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|numeric|exists:user_apps,id',
        ]);
        $success = 0; // no action
        $userProfile = UserApp::where('id', $request->user_id)->first();
        if(!$userProfile){
            return redirect()->back()->with('error', 'Opps! can\'t find user. Please try with correct data.');
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
        return redirect()->back()->with('success', ($success == 1) ? 'Unfollow user success' : 'Follow user success');
        // return response()->json([
        //     'status' => true,
        //     'code' => 1011,
        //     'message' =>  ($success == 1) ? 'Unfollow user success' : 'Follow user success'
        // ]);
    }

    public function getAllPost($request)
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
            },
            // 'followers as is_following' => function ($query) use ($profile) {
            //     $query->where('followables.user_apps_id', $profile->id);
            // },
            // 'following as following_count',
            // 'followers as followers_count'
        ];

        $blockedUsers = $profile->followings()->where('is_blocked', true)->pluck('user_follower.following_id')->all();
        Log::info('BlockedUsers --'.json_encode($blockedUsers));
        if($request->has('following') && $request->following){
            $following = array_merge($profile->followings()->pluck('user_follower.id')->all(), [$profile->id]);
            $posts = Post::with(['user', 'tags'])->where('status', 'Active')->whereNotIn('user_apps_id', $blockedUsers)->whereIn('user_apps_id', $following)->orderBy('created_at', 'desc');
        }else{
            $posts = Post::with(['user', 'tags', 'comment', 'comment.user'])
            ->where('status', 'Active')->whereNotIn('user_apps_id', $blockedUsers)->orderBy('created_at', 'desc');
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
        return $posts;
    }

    /**
     * open landing page
    */
    public function openLandingPage()
    {
        $title = 'Landing Page';
        return view('frontend.open_landing', compact([
            'title',
        ]));
    }
}
