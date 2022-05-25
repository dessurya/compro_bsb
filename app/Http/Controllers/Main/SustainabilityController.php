<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sustainability;

class SustainabilityController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'Sustainability';
        $banner = url('pict_content_asset/_default/home_1.jpg');
        $Sustainability = Sustainability::where([
            'flag_publish' => 'Y',
            'language' => $lang
        ])->orderBy('position','asc')->get();
        $css = [
        ];
        $js = [
        ];
        return view('main.page.sustainability', compact('lang','css','js','title_page','banner','Sustainability'));
    }
}
