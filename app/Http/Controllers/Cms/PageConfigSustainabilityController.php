<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageConfigSustainabilityController extends Controller
{
    protected $getFileDir = 'config_json/sustainability.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'title' => [
                'id' => 'Sustainability',
                'en' => 'Sustainability',
            ],
            'description' => [
                'id' => null,
                'en' => null,
            ],
            'banner' => [
                'img' => null
            ]
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.page-config-sustainability', compact( 'arrConf' ));
    }

    public function store(Request $httpRequest)
    {
        $res = ['response' => true];
        $file = $this->getFileDir;
        $arrConf = json_decode(file_get_contents($file),true);
        if ($httpRequest->type == 'string') {
            $new_arr = $this->storeString($arrConf,$httpRequest->input());
        }else if ($httpRequest->type == 'img') {
            $new_arr = $this->storeImg($arrConf,$httpRequest->input());
        }
        unlink($file);
        file_put_contents($file, json_encode($new_arr));
        return response()->json($res);
    }

    private function storeString($arrConf,$input)
    {
        $arrConf['title']['id'] = $input['title_id'];
        $arrConf['title']['en'] = $input['title_en'];
        $arrConf['description']['id'] = $input['description_id'];
        $arrConf['description']['en'] = $input['description_en'];
        return $arrConf;
    }

    private function storeImg($arrConf,$input)
    {
        if (isset($arrConf[$input['for']][$input['key']]) and !empty($arrConf[$input['for']][$input['key']])) { unlink($arrConf[$input['for']][$input['key']]); }
        $dir_estimate = 'config_img';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.$input['for'].'_'.$input['key'].'_'.$input['img_name'];
        try {
            file_put_contents($path_file, base64_decode($input['img_encode']));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return response()->json([
                'response' => false,
                'http_req' => $msg
            ]);
        }
        $arrConf[$input['for']][$input['key']] = $path_file;
        return $arrConf;
    }
}
