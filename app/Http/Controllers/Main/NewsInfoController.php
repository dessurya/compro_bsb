<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\NewsInfo;
use App\Models\NavigationConfig;

class NewsInfoController extends Controller
{
    protected $dirConfig = 'config_json/news-info.json';

    private function getConfigJSON($dirFile)
    {
        if (file_exists($dirFile)){ return json_decode(file_get_contents($dirFile),true); }
        else { return false; }
    }

    public function index()
    {
        $config = $this->getConfigJSON($this->dirConfig);
        if ($config == false) {
            return response()->json([
                'response' => true,
                'msg' => 'This underconstruction'
            ]);
        }
        $arrConfig = NavigationConfig::whereIn('identity',['News & Info'])->first();

        $lang = App::getLocale();
        $meta_title = json_decode($arrConfig->meta_title,true);
        $meta_description = json_decode($arrConfig->meta_description,true);
        $meta_keywords = json_decode($arrConfig->meta_keywords,true);
        $meta = [
            'author' => $arrConfig->meta_author,
            'title' => $meta_title[$lang],
            'description' => $meta_description[$lang],
            'keywords' => $meta_keywords[$lang],
        ];
        $title_page = $config['title'][$lang];
        $banner = url($config['banner']['img']);
        $NewsInfo = NewsInfo::where(['language'=>$lang,'flag_publish'=>'Y'])->orderBy('publish_date','desc')->paginate(3);
        $css = [
            url('asset\main\css\news-info.css').'?v='.date('Ym'),
        ];
        $js = [
        ];

        return view('main.page.news-info', compact('lang','css','js','title_page','NewsInfo','banner','meta'));
    }

    public function detail($slug)
    {
        $NewsInfo = NewsInfo::where(['flag_publish'=>'Y','slug'=>$slug])->firstOrFail();
        $meta = [
            'author' => $NewsInfo->created_by,
            'title' => $NewsInfo->meta_title,
            'description' => $NewsInfo->meta_keyword,
            'keywords' => $NewsInfo->meta_description,
        ];
        $css = [
        ];
        $js = [
        ];
        return view('main.page.news-info-detail', compact('css','js','NewsInfo','meta'));
    }
}
