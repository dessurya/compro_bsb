<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicConfigController extends Controller
{
    protected $getFileDir = 'config_json/public.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'web'=>['name' => null],
            'navigasi'=>[],
            'email'=>'<p>info.bsb@arseri.co.id</p>',
            'phone'=>'<p>021 83796375</p>',
            'address'=>'<p>Perkantoran Crown Place Block B 02-03</p><p>Jl. Prof. Dr Soepomo no 231</p><p>Jakarta 12870 - Indonesia</p>',
            'media_social'=>[],
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.public-config', compact( 'arrConf' ));
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
        }else if ($httpRequest->type == 'remove_media_social') {
            $new_arr = $this->removeMediaSocial($arrConf,$httpRequest->input());
        }else if ($httpRequest->type == 'string_media_social') {
            $storeMediaSocial = $this->storeMediaSocial($arrConf,$httpRequest->input());
            $new_arr = $storeMediaSocial['new_arr'];
            $res['idx'] = $storeMediaSocial['idx'];
        }else if ($httpRequest->type == 'img_media_social') {
            $storeImgMediaSocial = $this->storeImgMediaSocial($arrConf,$httpRequest->input());
            $new_arr = $storeImgMediaSocial['new_arr'];
            $res['idx'] = $storeImgMediaSocial['idx'];
        }
        unlink($file);
        file_put_contents($file, json_encode($new_arr));
        return response()->json($res);
    }

    private function storeMediaSocial($arrConf,$input){
        $newMedSos = [];
        $medSos = $arrConf['media_social'];
        foreach ($medSos as $idx => $data) { if (isset($data['identity'])) { $newMedSos[$idx] = $data; } }
        $idx = date('Ymdhis');
        $newMedSos[$idx] = [
            'identity' => $input['identity'],
            'url' => $input['url'],
            'img_dark' => null,
            'img_light' => null,
        ];
        $arrConf['media_social'] = $newMedSos;
        return ['new_arr' => $arrConf, 'idx' => $idx];
    }

    private function storeImgMediaSocial($arrConf,$input){
        $idx = $input['idx'];
        $dir_estimate = 'config_img';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.$idx.'_'.$input['key'].'_'.$input['img_name'];
        try {
            file_put_contents($path_file, base64_decode($input['img_encode']));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return response()->json([
                'response' => false,
                'http_req' => $msg
            ]);
        }
        $arrConf['media_social'][$idx]['img_'.$input['key']] = null;
        return ['new_arr' => $arrConf, 'idx' => $idx];
    }

    private function removeMediaSocial($arrConf,$input)
    {
        $newMedSos = [];
        $medSos = $arrConf['media_social'];
        foreach ($medSos as $idx => $data) {
            if ($idx == $input['idx']) {
                if (file_exists($data['img_dark'])){ unlink($data['img_dark']); }
                if (file_exists($data['img_light'])){ unlink($data['img_light']); }
            }else{
                $newMedSos[$idx] = $data;
            }
        }
        $arrConf['media_social'] = $newMedSos;
        return $arrConf;
    }

    private function storeString($arrConf,$input)
    {
        $arrConf['web']['name'] = $input['web_name'];
        $arrConf['address'] = $input['address'];
        $arrConf['email'] = $input['email'];
        $arrConf['phone'] = $input['phone'];
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
