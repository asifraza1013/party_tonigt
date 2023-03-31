<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reason',
        'report_for',
        'type',
        'status',
    ];
    public function post()
    {
        return $this->belongsTo('App\Post','report_for');
    }
}
