<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $table = 'founder';
    protected $fillable = [
        'name',
        'job_title_en',
        'job_title_id',
        'position',
        'img',
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
