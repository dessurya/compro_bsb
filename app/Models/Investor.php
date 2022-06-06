<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $table = 'investor';
    protected $fillable = [
        'name',
        'img',
        'content_id',
        'content_en',
        'flag_publish',
        'created_by'
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
