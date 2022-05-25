<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageConfigHomeController extends Controller
{
    protected $getFileDir = 'config_json/home.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'banner' => [
                'max_item' => 3,
            ],
            'news_info' => [
                'max_item' => 3,
            ],
            'quotes' => [
                'line' => [
                    'id' => [
                        1 => 'Kami tidak hanya mengejar keuntungan',
                        2 => 'Tetapi reputasi yang layak dibanggakan bangsa dan negara',
                    ],
                    'en' => [
                        1 => 'Kami tidak hanya mengejar keuntungan',
                        2 => 'Tetapi reputasi yang layak dibanggakan bangsa dan negara',
                    ]
                ],
                'imgs_1' => null,
                'imgs_2' => null,
                'imgs_3' => null,
                'imgs_4' => null,
            ],
            'our_client' => [
                'background' => null,
                'img' => null,
            ],
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.page-config-home', compact( 'arrConf' ));
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
        $arrConf['banner']['max_item'] = $input['banner_max_item'];
        $arrConf['news_info']['max_item'] = $input['news_info_max_item'];
        $arrConf['quotes']['line']['id'][1] = $input['quotes_line_id_1'];
        $arrConf['quotes']['line']['id'][2] = $input['quotes_line_id_2'];
        $arrConf['quotes']['line']['en'][1] = $input['quotes_line_en_1'];
        $arrConf['quotes']['line']['en'][2] = $input['quotes_line_en_2'];
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
        $path_file = $dir_file.'home_'.$input['for'].'_'.$input['key'].'_'.$input['img_name'];
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
