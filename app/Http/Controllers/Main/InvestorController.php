<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'Investor';
        $banner = url('pict_content_asset/_default/home_1.jpg');
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
