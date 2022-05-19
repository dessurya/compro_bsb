<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Product;

class OurProductController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'Our Product';
        $banner = url('pict_content_asset/_default/home_1.jpg');
        $products = Product::where(['language'=>$lang,'flag_publish'=>'Y'])->orderBy('position','asc')->get();
        $css = [
        ];
        $js = [
        ];

        return view('main.page.our-product', compact('lang','css','js','title_page','products','banner'));
    }
}
