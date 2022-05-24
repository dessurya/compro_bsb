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

Use Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();

        $banner = Banner::where('flag_publish','Y')->orderBy('queues','ASC')->get();
        $quotes_img = [
            // ['title' => 'title 1', 'img'=>url('pict_content_asset/_default/img (3).jpg')],
            // ['title' => 'title 2', 'img'=>url('pict_content_asset/_default/img (4).jpg')],
            // ['title' => 'title 3', 'img'=>url('pict_content_asset/_default/img (1).jpg')],
            ['title' => 'title 4', 'img'=>url('pict_content_asset/_default/home_1.jpg')],
            ['title' => 'title 4', 'img'=>url('pict_content_asset/_default/home_2.jpg')],
            ['title' => 'title 4', 'img'=>url('pict_content_asset/_default/gambar 3.jpg')],
            ['title' => 'title 4', 'img'=>url('pict_content_asset/_default/home_3.jpg')],
        ];
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
        ])->orderBy('publish_date','desc')->limit(5)->get();

        $css = [
            url('vendors\owlcarousel\owl.carousel.css'),
            url('vendors\owlcarousel\owl.theme.css'),
        ];
        $js = [
            url('vendors\owlcarousel\owl.carousel.js'),
        ];
        return view('main.page.home', compact(
            'banner','product','sustainability','css','js','quotes_img','news'
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
        return 'Trial';
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
        $menu = [
            [ 'label' => 'About Us', 'route' => route('main.about-us') ],
            [ 'label' => 'Our Product', 'route' => route('main.our-product') ],
            [ 'label' => 'Sustainability', 'route' => '#' ],
            [ 'label' => 'Our Client', 'route' => '#' ],
            [ 'label' => 'News & Info', 'route' => route('main.news-info') ],
            [ 'label' => 'Investor', 'route' => '#' ],
            [ 'label' => 'Career', 'route' => '#' ],
            [ 'label' => 'Contact Us', 'route' => '#' ],
        ];
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
