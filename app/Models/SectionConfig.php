<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionConfig extends Model
{
    protected $table = 'section_config';
    protected $fillable = [
        'identity',
        'flag_visible',
        'value_of_json',
    ];
    public function getCreatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function getUpdatedAtAttribute($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function setValueOfJsonAttribute($value)
    { 
        return $this->attributes['value_of_json'] = json_encode($value);
    }

    public function getValueOfJsonAttribute($value)
    { 
        return json_decode($value,true);
    }
}
