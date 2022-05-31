<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Sustainability;
use App\Models\NewsInfo;

use App\Models\NavigationConfig;

Use Redirect;

class HomeController extends Controller
{
    protected static $dirPublicConfig = 'config_json/public.json';
    protected $dirHomeConfig = 'config_json/home.json';

    private function getConfigJSON($dirFile)
    {
        if (file_exists($dirFile)){ return json_decode(file_get_contents($dirFile),true); }
        else { return false; }
    }
    
    public function index()
    {
        $config = $this->getConfigJSON($this->dirHomeConfig);
        if ($config == false) {
            return response()->json([
                'response' => true,
                'msg' => 'This underconstruction'
            ]);
        }
        $lang = App::getLocale();
        $pageConfig = [];
        $arrConfig = NavigationConfig::whereIn('identity',['Home','Our Product','Sustainability','Our Client','News & Info'])->get();
        foreach ($arrConfig as $key => $value) {
            $label = json_decode($value->name,true);
            $pageConfig[$value->identity] = $label[$lang];
            if ($value->identity == 'Home') {
                $meta_title = json_decode($value->meta_title,true);
                $meta_description = json_decode($value->meta_description,true);
                $meta_keywords = json_decode($value->meta_keywords,true);
                $meta = [
                    'author' => $value->meta_author,
                    'title' => $meta_title[$lang],
                    'description' => $meta_description[$lang],
                    'keywords' => $meta_keywords[$lang],
                ];
            }
        }
        
        $banner = Banner::where('flag_publish','Y')->orderBy('queues','ASC')->limit($config['banner']['max_item'])->get();
        $quotes = $config['quotes']['line'][$lang];
        $quotes_img = [];
        if ($config['quotes']['imgs_1'] != null) { $quotes_img[] = ['title' => 'img 1', 'img'=>url($config['quotes']['imgs_1'])]; }
        if ($config['quotes']['imgs_2'] != null) { $quotes_img[] = ['title' => 'img 2', 'img'=>url($config['quotes']['imgs_2'])]; }
        if ($config['quotes']['imgs_3'] != null) { $quotes_img[] = ['title' => 'img 3', 'img'=>url($config['quotes']['imgs_3'])]; }
        if ($config['quotes']['imgs_4'] != null) { $quotes_img[] = ['title' => 'img 4', 'img'=>url($config['quotes']['imgs_4'])]; }
        $product = Product::where([
            'flag_publish'=>'Y',
            'language'=>$lang
        ])->orderBy('position','asc')->get();

        $sustainability = Sustainability::where([
            'flag_publish' => 'Y',
            'language' => $lang
        ])->orderBy('position','asc')->get();

        $news = NewsInfo::where([
            'flag_publish' => 'Y',
            'language' => $lang
        ])->orderBy('publish_date','desc')->limit($config['news_info']['max_item'])->get();

        $css = [
            url('vendors\owlcarousel\owl.carousel.css'),
            url('vendors\owlcarousel\owl.theme.css'),
        ];
        $js = [
            url('vendors\owlcarousel\owl.carousel.js'),
        ];
        return view('main.page.home', compact(
            'banner','product','sustainability','css','js','quotes_img','quotes','news','pageConfig',
            'meta'
        ));
    }

    public function changeLanguage()
    {
        $brfore = Session::get('applocale');
        if ($brfore == 'id') { Session::put('applocale', 'en'); }
        else { Session::put('applocale', 'id'); }
        return Redirect::back();
    }

    public static function getWebName()
    {
        $config = self::getConfigJSON(self::$dirPublicConfig);
        return $config['web']['name'];
    }

    public static function getWebIcon()
    {
        return null;
    }

    public static function getLangIcon($route,$lang)
    {
        $clr = 'blue';
        if ($route == 'main.home') { $clr = 'white'; }
        return url('pict_content_asset/_default/lang_'.$clr.'_'.$lang.'.png');
    }

    public static function getHeader()
    {
        $lang = App::currentLocale();
        $icon = url('pict_content_asset/_default/logo.png');
        $route = [
            'Our Product' => route('main.about-us') ,
            'Our Product' => route('main.our-product') ,
            'Sustainability' => route('main.sustainability') ,
            'Our Client' => route('main.our-client') ,
            'News & Info' => route('main.news-info') ,
            'Investor' => route('main.investor') ,
            'Career' => '#' ,
            'Contact Us' => route('main.contact') ,
        ];
        $nav = NavigationConfig::where('flag_show','Y')->orderBy('position','asc')->get();
        $menu = [];
        foreach ($nav as $key => $value) {
            if ($value->identity != 'Home') {
                $label = json_decode($value->name,true);
                $menu[] = [ 'label' => $label[$lang], 'route' => $route[$value->identity] ];
            }
        }
        
        echo view('main._struct.header', compact('menu','icon','lang'))->render();
    }

    public static function getFooter()
    {
        $arr = [];
        $crYear = '2022';
        if (date('Y') != 2022) { $crYear .= ' - '.date('Y'); }
        $arr['copyright'] = $crYear;
        $find = [
            url('pict_content_asset/_default/fb-dark.png'),
            url('pict_content_asset/_default/ig-dark.png'),
        ];
        $arr['find'] = $find;
        $config = self::getConfigJSON(self::$dirPublicConfig);
        $arr['address'] = $config['address'];
        $arr['email'] = $config['email'];
        $arr['phone'] = $config['phone'];
        echo view('main._struct.footer', compact('arr'))->render();
    }

    public static function buildTitle($str)
    {
        $expl = explode(" ", $str);
        $res_expl = [];
        foreach ($expl as $data) { $res_expl[] = '<span>'.$data.'</span>'; }
        return implode(" ",$res_expl);
    }
}
