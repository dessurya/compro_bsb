<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsInfoImg extends Model
{
    protected $table = 'news_info_img';
    protected $fillable = [
        'news_info_id',
        'img',
    ];

    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function setSlugAttribute($value)
    { 
        return $this->attributes['slug'] = Str::slug($value, '-');; 
    }
}
