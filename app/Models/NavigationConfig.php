<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationConfig extends Model
{
    protected $table = 'navigation_page';
    protected $fillable = [
        'identity',
        'name',
        'meta_author',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'position',
        'flag_show',
        'last_modify_by'
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
