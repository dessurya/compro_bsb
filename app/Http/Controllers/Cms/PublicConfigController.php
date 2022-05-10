<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicConfigController extends Controller
{
    public function index()
    {
        $arrConf = json_decode(file_get_contents('config_json/public.json'),true);
        $arrConf['asd'] = ['asd' => 'asd'];
        file_put_contents('config_json/public_asd.json', json_encode($arrConf));
        return $arrConf;
    }
}
