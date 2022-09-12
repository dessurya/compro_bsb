<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Product;
use App\Models\NavigationConfig;

class OurProductController extends Controller
{
    protected $dirConfig = 'config_json/our-product.json';

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
        $arrConfig = NavigationConfig::whereIn('identity',['Our Product'])->first();
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
        $products = Product::where(['language'=>$lang,'flag_publish'=>'Y'])->orderBy('position','asc')->get();
        $css = [
            url('asset\main\css\product.css').'?v='.date('Ym').'1',
        ];
        $js = [
        ];

        return view('main.page.our-product', compact('lang','css','js','title_page','products','banner','meta'));
    }
}
