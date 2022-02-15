<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $lang;

    function __construct()
    {
        $this->lang = App::currentLocale();
    }

    public function index()
    {
        $config = null;
        $banner = [
            'https://drive.google.com/uc?export=view&id=1GkyGt3-VRLuuG1Uu-nxIEKJ_ma5ASH-A',
            url('pict_content_asset/_default/img (2).jpg'),
            url('pict_content_asset/_default/img (7).jpg'),
            // url('pict_content_asset/_default/gambar 2.jpg'),
            // url('pict_content_asset/_default/gambar 1.jpg'),
        ];
        // $banner = [
        //     'https://drive.google.com/uc?export=view&id=1JNPR6Wq67EjaSZmiS2OTKeMwKzLKxv5H',
        //     'https://drive.google.com/uc?export=view&id=1aw0lzdxhIjlgqd6nJffygYhtSyyi0bkX',
        // ];
        $quotes_img = [
            ['title' => 'title 3', 'img'=>url('pict_content_asset/_default/img (3).jpg')],
            ['title' => 'title 3', 'img'=>url('pict_content_asset/_default/img (4).jpg')],
            ['title' => 'title 3', 'img'=>url('pict_content_asset/_default/img (1).jpg')],
            ['title' => 'title 3', 'img'=>url('pict_content_asset/_default/gambar 3.jpg')],
        ];
        $product = [
            [
                'img' => url('pict_content_asset/_default/mutiara.png'),
                'title' => 'Mutiara',
                'desc' => 'Budi daya Mutiara PT. Bima Sakti Bahari merupakan satu-satunya budi daya mutiara terbesar'
            ],
            [
                'img' => url('pict_content_asset/_default/lobster.png'),
                'title' => 'Lobster',
                'desc' => 'Kegiatan budi daya Lobster di lokasi PT. Bima Sakti Bahari diterapkan secara mandiri maupun dengan'
            ],
            [
                'img' => url('pict_content_asset/_default/weed.png'),
                'title' => 'Rumput Laut',
                'desc' => 'Salah satu komoditi perairan yang cukup memiliki potensial di Indonesia adalah rumput laut. Lokasi'
            ],
            [
                'img' => url('pict_content_asset/_default/tripang.png'),
                'title' => 'Teripang',
                'desc' => 'Salah satu komoditi perairan yang cukup memiliki potensial di Indonesia adalah rumput laut. Lokasi'
            ]
        ];
        $sustainability = [
            [
                'img' => url('pict_content_asset/_default/5.jpg'),
                'title' => 'People',
                'desc' => 'lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet'
            ],
            [
                'img' => url('pict_content_asset/_default/6.jpg'),
                'title' => 'Planet',
                'desc' => 'lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet'
            ],
            [
                'img' => url('pict_content_asset/_default/7.jpg'),
                'title' => 'Profit',
                'desc' => 'lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet lorem ipsum dolar si amet'
            ]
        ];
        $css = [
            url('vendors\owlcarousel\owl.carousel.css'),
            url('vendors\owlcarousel\owl.theme.css'),
        ];
        $js = [
            url('vendors\owlcarousel\owl.carousel.js'),
        ];
        return view('main.page.home', compact(
            'config','banner','product','sustainability','css','js','quotes_img'
        ));
    }

    public function changeLanguage()
    {
        // $arrLang = Config::get('language');
        if ($this->lang == 'id') { Session::put('applocale', 'en'); }
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

    public static function getHeader()
    {
        $icon = url('pict_content_asset/_default/logo.png');
        $menu = [
            [ 'label' => 'About Us', 'route' => '#' ],
            [ 'label' => 'Our Product', 'route' => '#' ],
            [ 'label' => 'Sustainability', 'route' => '#' ],
            [ 'label' => 'Our Client', 'route' => '#' ],
            [ 'label' => 'News & Info', 'route' => '#' ],
            [ 'label' => 'Investor', 'route' => '#' ],
            [ 'label' => 'Career', 'route' => '#' ],
            [ 'label' => 'Contact Us', 'route' => '#' ],
        ];
        echo view('main._struct.header', compact('menu','icon'))->render();
    }

    public static function getFooter()
    {
        $arr = [];
        $crYear = '2022';
        if (date('Y') != 2022) { $crYear .= ' - '.date('Y'); }
        $arr['copyright'] = $crYear;
        $find = [
            url('pict_content_asset/_default/fb.png'),
            url('pict_content_asset/_default/ig.png'),
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
