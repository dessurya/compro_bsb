<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sustainability extends Model
{
    protected $table = 'sustainability';
    protected $fillable = [
        'title',
        'language',
        'position',
        'content_shoert',
        'img_thumnail',
        'flag_publish',
        'created_by',
    ];
    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
}
