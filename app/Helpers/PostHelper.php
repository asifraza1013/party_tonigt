<?php

namespace App\Helpers;

use App\CommentActivity as AppCommentActivity;
use App\Models\PostActivity as AppPostActivity;
use App\Models\Post as AppPost;
use App\Post;
use App\Comment;
use App\Models\DeviceToken;
use App\UserApp;

class PostHelper
{
    static function createPostActivity($profile, $post, $type)
    {
        $postId = $post->id;
        $activity = new AppPostActivity();
        $activity->user_apps_id = $profile->id;
        $activity->post_id = $postId;
        $activity->type = $type;
        $activity->save();

	if($post->user_apps_id == $profile->id){
        return 1;
    }else{
        return 1;
    }

        $title = "New Activity on your post";
        $body = null;
        $data = array();
        switch($type) {
            case config('constants.POST_ACTIVITY_LIKE'):
                if(!$profile->notification_on_like) {
                    return;
                }
                $body = "Someone liked your post";
                $data = ["post_id" => $postId];
                break;
            case config('constants.POST_ACTIVITY_DISLIKE'):
                if(!$profile->notification_on_dislike) {
                    return;
                }
                $body = "Someone disliked your post";
                $data = ["post_id" => $postId];
                break;
            case config('constants.POST_ACTIVITY_COMMENT'):
                if(!$profile->notification_on_comment) {
                    return;
                }
                $body = "Someone commented on your post";
                $data = ["post_id" => $postId];
                break;
        }
	    // $notifyUser = UserApp::find(Post::find($postId)->user_apps_id)->first();
	    $deviceToken = DeviceToken::where('user_apps_id', $profile->id)->pluck(['device_token']);
        PushNotificationHelper::send($deviceToken, $title, $body, $data);
    }

    static function createCommentActivity($profile, $comment, $type)
    {
        $commentId = $comment->id;
        $activity = new AppCommentActivity();
        $activity->user_apps_id = $profile->id;
        $activity->comment_id = $commentId;
        $activity->type = $type;
        $activity->save();

	if($comment->user_apps_id == $profile->id) { return 1; }

        $title = "New Activity on your post";
        $body = "";
        $data = array();
        switch($type) {
            case config('constants.POST_ACTIVITY_LIKE'):
                $body = "Someone liked your comment";
                $data = ["comment_id" => $commentId];
                break;
            case config('constants.POST_ACTIVITY_DISLIKE'):
                $body = "Someone disliked your comment";
                $data = ["comment_id" => $commentId];
                break;
        }
	    // $notifyUser = UserApp::find(Comment::find($commentId)->user_apps_id)->first();
	    $deviceToken = DeviceToken::where('user_apps_id', $profile->id)->pluck(['device_token']);
        PushNotificationHelper::send($deviceToken, $title, $body, $data);
        return 1;
    }
}
