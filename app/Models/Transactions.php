<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\UserApp','user_id', 'id');
    }
}
