<?php
namespace App\Helper;

use Illuminate\Support\Str;
use App\Models\UserHistory;

class HelperService {
	public static function userHistoryStore($module, $activity){
		$record = new UserHistory;
        $record->module = Str::title($module);
        $record->activity = $activity;
        $record->save();
	}	
}