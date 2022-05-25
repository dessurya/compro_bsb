<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurClientController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'Our Client';
        $page_data = [
            'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
            'img' => url('config_img/client.png')
        ];
        $css = [
        ];
        $js = [
        ];
        return view('main.page.sustainability', compact('lang','css','js','title_page','page_data'));
    }
}
