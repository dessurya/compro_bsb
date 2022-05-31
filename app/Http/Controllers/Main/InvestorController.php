<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NavigationConfig;

class InvestorController extends Controller
{
    protected $dirConfig = 'config_json/investor.json';

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
        $arrConfig = NavigationConfig::whereIn('identity',['Investor'])->first();
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

        $investor = [
            [
                'name' => 'PT. BIMA SAKTI BAHARI',
                'content' => '<p>Perkantoran Crown Place Block B 02-03</p><p>Jl. Prof. Dr Soepomo no 231</p><p>Jakarta 12870 - Indonesia</p>',
                'img' => url('pict_content_asset/_default/home_1.jpg')
            ]
        ];
        $css = [
        ];
        $js = [
        ];
        return view('main.page.investor', compact('lang','css','js','title_page','banner','investor'));
    }
}
