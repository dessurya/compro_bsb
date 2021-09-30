<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserHistory extends Model
{
    protected $table = 'users_history';
    protected $fillable = [
        'name',
        'email',
        'module',
        'activity',
    ];
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public static function boot() 
    {
		parent::boot();
		self::creating(function ($selfM) {
            if (empty($selfM->name)) { $selfM->name = Auth::user()->name; }
            if (empty($selfM->email)) { $selfM->email = Auth::user()->email; }
		});
    }
}
