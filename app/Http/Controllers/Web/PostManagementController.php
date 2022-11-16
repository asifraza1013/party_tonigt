<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
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
        $posts = $this->getAllPost($request);

        return view('frontend.landing_page', compact([
            'posts',
            'title',
            'user',
        ]));
    }


    public function createNewEvent(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'ticket_price' => 'required_if:ticket_detail,==,on|numeric',
            'total_tickets' => 'required_if:ticket_detail,==,on|numeric',
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
        if(!empty($request->tags)) $post->tags = $request->tags;
        if(!empty($request->friends)) $post->friends = $request->friends;
        if(!empty($request->ticket_price)) $post->price = $request->ticket_price;
        if(!empty($request->total_tickets)) $post->total_tickets = $request->total_tickets;

        if($request->ticket_detail == 'on') $post->is_event = true;
        $post->save();
        if(!empty($request->tags)) $post->attachTags($request->tags);
        return redirect()->back()->with('success', 'New Event created successfully.');
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
            $posts = Post::with(['user', 'tags'])->where('status', 'Active')->whereNotIn('user_apps_id', $blockedUsers)->orderBy('created_at', 'desc');
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
}
