<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        'media_url' => 'array',
        'tags' => 'array',
        'friends' => 'array',
    ];
    protected $appends = ['cate_name'];
    public function getUserProfileIdAttribute($value)
    {
        return UserApp::select(['id', 'user_name','gender', 'image'])->find($value);
    }

    public function post_activities()
    {
        return $this->hasMany('App\Models\PostActivity');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\UserApp','user_apps_id');
    }
    public function getCateNameAttribute()
    {
        return config('constants.post_categories.'.$this->category);
    }
}
