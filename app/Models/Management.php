<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'management';
    protected $fillable = [
        'name',
        'job_title_en',
        'job_title_id',
        'queues',
        'quotes_en',
        'quotes_id',
        'text_en',
        'text_id',
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
