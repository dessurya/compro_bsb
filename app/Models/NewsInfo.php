<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;

class NewsInfo extends Model
{
    protected $table = 'news_info';
    protected $fillable = [
        'title',
        'slug',
        'publish_date',
        'language',
        'content',
        'img',
        'created_by',
        'flag_img',
        'flag_publish',
    ];
    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function boot() 
    {
		parent::boot();
		self::creating(function ($selfM) {
            if (empty($selfM->slug)) { $selfM->slug = Str::slug($selfM->title, '-'); }
            if (empty($selfM->created_by)) { $selfM->created_by = Auth::user()->name; }
		});
    }
}
