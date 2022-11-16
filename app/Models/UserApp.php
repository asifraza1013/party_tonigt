<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;
use Overtrue\LaravelFollow\Follower;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserApp extends Authenticatable
{
    use Notifiable, HasApiTokens, Followable;

    protected $guard = 'client';
    protected $guarded=['id'];
    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
    protected $fillable = [
        'google_id',
        'apple_id',
        'image',
        'otp',
        'admin_approved',
        'enable_notifications',
        'status',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'status',
        'user_name',
    ];

    public function activities()
    {
        return $this->hasManyThrough('App\Model\PostActivity', 'App\Model\Post', 'user_apps_id', 'post_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Model\Post', 'user_apps_id');
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
}
