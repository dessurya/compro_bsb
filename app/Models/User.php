<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
	protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'flag_active',
        'flag_notif_inbox',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function setPasswordAttribute($value)
    { 
        return $this->attributes['password'] = Hash::make($value); 
    }

    public static function boot() 
    {
		parent::boot();
		self::creating(function ($selfM) {
            if (empty($selfM->password)) { $selfM->password = 'opencms123'; }
		});
    }
}
