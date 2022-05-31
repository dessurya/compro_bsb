<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NavigationConfig;

class OurClientController extends Controller
{
    protected $dirConfig = 'config_json/our-client.json';

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
        $arrConfig = NavigationConfig::whereIn('identity',['Our Client'])->first();
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
        $page_data = [
            'content' => $config['description'][$lang],
            'img' => url($config['maps']['img'])
        ];
        $css = [
        ];
        $js = [
        ];
        return view('main.page.our-client', compact('lang','css','js','title_page','page_data','meta'));
    }
}
