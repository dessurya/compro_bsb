<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class PublicConfigController extends Controller
{
    public function index()
    {
        // $arrConf = json_decode(File::get(storage_path('config_json/public.json')),true);
        // File::delete(storage_path('config_json/public.json'));
        $arrConf = ["asd"=>"Asd"];
        File::put(public_path('config_json/public.json'),json_encode($arrConf));
        return $arrConf;
    }
}
