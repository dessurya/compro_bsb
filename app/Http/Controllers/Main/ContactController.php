<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $title_page = 'Contact Us';
        $page_data = [
            'location' => [
                'title' => 'OUR LOCATION',
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
                'link' =>  'https://goo.gl/maps/woEJx9Ab2P2LJxkS6',
                'embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2000609936085!2d106.84129911436065!3d-6.237340962814857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3bfd8000a99%3A0x256688b63fa6c3fa!2sPT.%20Bima%20Sakti%20Bahari!5e0!3m2!1sid!2sid!4v1653443289080!5m2!1sid!2sid'
            ],
            'message' => [
                'img' => url('pict_content_asset/_default/home_1.jpg')
            ]
        ];
        $css = [
        ];
        $js = [
        ];
        return view('main.page.contact', compact('lang','css','js','title_page','page_data'));
    }

    public function store(Request $httpRequest)
    {
        return $httpRequest->input();
    }
}
