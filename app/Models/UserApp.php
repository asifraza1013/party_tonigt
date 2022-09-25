<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserApp extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guarded=['id'];
    protected $hidden = [
        'password',
        'user_name',
        'country',
        'dob',
    ];
    public $timestamps = true;
    protected $fillable = [
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
}
