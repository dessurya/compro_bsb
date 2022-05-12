<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageConfigAboutUsController extends Controller
{
    protected $getFileDir = 'config_json/about-us.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'banner' => [
                'max_item' => 3,
            ],
            'news_info' => [
                'max_item' => 3,
            ],
            'quotes' => [
                'line_1' => 'Kami tidak hanya mengejar keuntungan',
                'line_2' => 'Tetapi reputasi yang layak dibanggakan bangsa dan negara',
                'imgs_1' => null,
                'imgs_2' => null,
                'imgs_3' => null,
                'imgs_4' => null,
            ],
            'our_client' => [
                'background' => null,
                'img' => null,
            ],
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.page-config-home', compact( 'arrConf' ));
    }
}
