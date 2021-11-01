<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'title',
        'language',
        'position',
        'content_shoert',
        'content',
        'img_thumnail',
        'img_banner',
        'slug',
        'meta_keyword',
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
    public function setSlugAttribute($value)
    { 
        return $this->attributes['slug'] = Str::slug($value, '-');
    }
}
