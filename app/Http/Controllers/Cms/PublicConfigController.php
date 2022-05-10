<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicConfigController extends Controller
{
    public function index()
    {
        $arrConf = json_decode(file_get_contents('config_json/public.json'),true);
        // File::delete(storage_path('config_json/public.json'));
        // $arrConf['asdasdsd'] = ['asdas','asdadasdasdas'];
        // File::put(public_path('config_json/public_asdasd.json'),json_encode($arrConf));
        return $arrConf;
    }
}
