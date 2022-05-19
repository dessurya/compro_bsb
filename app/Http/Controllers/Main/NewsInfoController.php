<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\NewsInfo;

class NewsInfoController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'News & Info';
        $banner = url('pict_content_asset/_default/home_1.jpg');
        $NewsInfo = NewsInfo::where(['language'=>$lang,'flag_publish'=>'Y'])->orderBy('publish_date','desc')->paginate(8);
        $css = [
        ];
        $js = [
        ];

        return view('main.page.news-info', compact('lang','css','js','title_page','NewsInfo','banner'));
    }

    public function detail($slug)
    {
        $NewsInfo = NewsInfo::where(['flag_publish'=>'Y','slug'=>$slug])->firstOrFail();
        $css = [
        ];
        $js = [
        ];
        return $NewsInfo;
        return view('main.page.news-info-detail', compact('css','js','NewsInfo'));
    }
}
