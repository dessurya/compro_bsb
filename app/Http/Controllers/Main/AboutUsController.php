<?php

namespace App\Http\Controllers\MAin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Management;
use App\Models\NavigationConfig;

class AboutUsController extends Controller
{
    protected $dirConfig = 'config_json/about-us.json';

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

        $lang = App::getLocale();
        $arrConfig = NavigationConfig::whereIn('identity',['About Us'])->first();
        $meta_title = json_decode($arrConfig->meta_title,true);
        $meta_description = json_decode($arrConfig->meta_description,true);
        $meta_keywords = json_decode($arrConfig->meta_keywords,true);
        $meta = [
            'author' => $arrConfig->meta_author,
            'title' => $meta_title[$lang],
            'description' => $meta_description[$lang],
            'keywords' => $meta_keywords[$lang],
        ];
        $history = $config['intruduction'][$lang]['content'];
        $history_img = $config['intruduction']['img'];
        $visi = $config['visi'][$lang];
        $misi = $config['misi'][$lang];
        $title_visi = ['id'=>'VISI','en'=>'VISION'];
        $title_misi = ['id'=>'MISI','en'=>'MISION'];
        $title_page = [
            'intruduction' => [
                'bold'=>substr($config['intruduction'][$lang]['title'],0,2),
                'light'=>substr($config['intruduction'][$lang]['title'],2)
            ],
            'visi' => $title_visi[$lang],
            'misi' => $title_misi[$lang],
        ];

        $management = [];
        $getManagement = Management::where('flag_publish','Y')->orderBy('queues','ASC')->get();
        foreach ($getManagement as $idx => $data) {
            $set = [];
            $set['name'] = $data->name;
            $set['img'] = null;
            if (!empty($data->img)) {$set['img'] = url($data->img);}
            if ($lang == 'id') { $set['title'] = $data->job_title_id; }
            else { $set['title'] = $data->job_title_en; }
            if ($lang == 'id') { $set['quotes'] = $data->quotes_id; }
            else { $set['quotes'] = $data->quotes_en; }
            if ($lang == 'id') { $set['msg'] = $data->text_id; }
            else { $set['msg'] = $data->text_en; }
            $management[] = $set;
        }

        $css = [
        ];
        $js = [
        ];

        return view('main.page.about-us', compact('history','visi','misi','management','lang','css','js','title_page','meta','history_img'));
    }
}
