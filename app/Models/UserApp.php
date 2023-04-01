<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;
use Laravel\Sanctum\HasApiTokens;
// use Hootlex\Friendships\Traits\Friendable;
use App\Traits\FriendableTempFix;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserApp extends Authenticatable
{
    use Notifiable, HasApiTokens, Followable, HasFactory, FriendableTempFix;
    // use Friendable;

    protected $guard = 'client';
    protected $guarded=['id'];
    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
    protected $appends = ['full_name'];
    protected $fillable = [
        'google_id',
        'apple_id',
        'image',
        'otp',
        'admin_approved',
        'enable_notifications',
        'status',
        'gender',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'status',
        'user_name',
        'full_name',
        'about',
    ];

    public function activities()
    {
        return $this->hasManyThrough('App\Models\PostActivity', 'App\Models\Post', 'user_apps_id', 'post_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_apps_id');
    }

    // public function followers()
    // {
    //     return $this->hasMany('Overtrue\LaravelFollow\FollowRelation');
    // }

    // public function following()
    // {
    //     return $this->hasMany('Overtrue\LaravelFollow\FollowRelation');
    // }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function getMonthAttribute()
    {
        if($this->dob){
            $exploaded = explode('-', $this->dob);
            return $exploaded[1];
        }
    }
    public function getDayAttribute()
    {
        if($this->dob){
            $exploaded = explode('-', $this->dob);
            return $exploaded[0];
        }
    }
    public function getYearAttribute()
    {
        if($this->dob){
            $exploaded = explode('-', $this->dob);
            return $exploaded[2];
        }
    }

    public function needsToApproveFollowRequests()
    {
        // Your custom logic here
        return (bool) $this->private;
    }

    // Follower::attachFollowStatus(Collection $followables)
}
