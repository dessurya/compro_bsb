<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NavigationConfig;
use App\Models\Inbox;

use Session;

class ContactController extends Controller
{
    protected $dirConfig = 'config_json/contact.json';

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
        $arrConfig = NavigationConfig::whereIn('identity',['Contact Us'])->first();

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
        $name = json_decode($arrConfig->name,true);
        $title_page = $name[$lang];

        $page_data = [
            'location' => [
                'title' => $config['location']['title'][$lang],
                'content' => $config['location']['content'][$lang],
                'link' =>  $config['location']['link'],
                'embed' => $config['location']['embed']
            ],
            'message' => [
                'img' => url($config['message']['img'])
            ],
            'lelang' => [
                'title' => $config['lelang_config']['title'][$lang],
                'data' => $config['lelang'],
                'count' => count($config['lelang'])
            ]
        ];
        $css = [
            url('asset\main\css\contact.css').'?v='.date('Ym').'1',
        ];
        $js = [
        ];
        return view('main.page.contact', compact('lang','css','js','title_page','page_data','meta'));
    }

    public function store(Request $httpRequest)
    {
        $cek = Inbox::where('email',$httpRequest->email)->whereDate('created_at',now())->count();
        if ($cek <= 5) {
            Inbox::create([
                'name' => $httpRequest->name,
                'email' => $httpRequest->email,
                'subject' => $httpRequest->subject,
                'phone' => $httpRequest->phone,
                'message' => $httpRequest->message,
            ]);
            Session::flash('message', 'Berhasil terkirim!'); 
        }else{
            Session::flash('message', 'Anda telah melewati batas pengiriman pesan pada hari ini');
        }
        return redirect()->back();
    }
}
