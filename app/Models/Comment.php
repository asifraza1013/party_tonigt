<?php

namespace App\Models;

use App\Models\UserApp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    // use SoftDeletes;

    public function getUserProfileIdAttribute($value)
    {
	return UserApp::select(['id', 'user_name','gender', 'image'])->find($value);
    }

    // public function comment_activities()
    // {
    //     return $this->hasMany('App\CommentActivity');
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\UserApp', 'user_apps_id');
    }
}
