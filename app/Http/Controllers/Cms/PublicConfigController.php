<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicConfigController extends Controller
{
    public function index()
    {
        $arrConf = json_decode(file_get_contents('config_json/public.json'),true);
        return view('cms.page.public-config', compact( 'arrConf' ));
    }
    
    public function store(Request $httpRequest)
    {
        $file = 'config_json/public.json';
        $arrConf = json_decode(file_get_contents($file),true);
        if ($httpRequest->type == 'string') {
            $res = $this->storeString($arrConf,$httpRequest->input());
        }else if ($httpRequest->type == 'img') {
            $res = $this->storeImg($arrConf,$httpRequest->input());
        }
        unlink($file);
        file_put_contents($file, json_encode($res));
    }

    private function storeString($arrConf,$input)
    {
        $arrConf['web']['name'] = $input['web_name'];
        return $arrConf;
    }

    private function storeImg($arrConf,$input)
    {
        if (isset($arrConf[$input['for']][$input['key']]) and !empty($arrConf[$input['for']][$input['key']])) { unlink($arrConf[$input['for']][$input['key']]); }
        $dir_estimate = 'config_img';
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
