<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageConfigContactUsController extends Controller
{
    protected $getFileDir = 'config_json/contact.json';

    public function index()
    {
        $file = $this->getFileDir;
        $arrConf = [
            'location' => [
                'title' => [
                    'id' => 'LOKASI KAMI',
                    'en' => 'OUR LOCATION',
                ],
                'content' => [
                    'id' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
                ],
                'link' =>  'https://goo.gl/maps/woEJx9Ab2P2LJxkS6',
                'embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2000609936085!2d106.84129911436065!3d-6.237340962814857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3bfd8000a99%3A0x256688b63fa6c3fa!2sPT.%20Bima%20Sakti%20Bahari!5e0!3m2!1sid!2sid!4v1653443289080!5m2!1sid!2sid'
            ],
            'message' => [
                'img' => null
            ],
            'lelang_config' => [
                'title' => [
                    'id' => 'JADWAL LELANG',
                    'en' => 'JADWAL LELANG',
                ]
            ],
            'lelang' => []
        ];
        if (file_exists($file)){ $arrConf = json_decode(file_get_contents($file),true); }
        else{file_put_contents($file, json_encode($arrConf));}
        return view('cms.page.page-config-contact-us', compact( 'arrConf' ));
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
        }else if ($httpRequest->type == 'lelang') {
            $new_arr = $this->storeLelang($arrConf,$httpRequest->input());
        }else if ($httpRequest->type == 'remove_lelang') {
            $new_arr = $this->removeLelang($arrConf,$httpRequest->input());
        }
        unlink($file);
        file_put_contents($file, json_encode($new_arr));
        return response()->json($res);
    }

    private function removeLelang($arrConf,$input)
    {
        $newLelang = [];
        $Lelang = $arrConf['lelang'];
        foreach ($Lelang as $idx => $data) { if ($idx != $input['idx']) { $newLelang[$idx] = $data; } }
        $arrConf['lelang'] = $newLelang;
        return $arrConf;
    }

    private function storeLelang($arrConf,$input)
    {
        if (empty($input['id']) or $input['id'] == null or $input['id'] == '') { $idx = date('Ymdhis'); }
        else { $idx = $input['id']; }

        $arrConf['lelang'][$idx] = [
            'lokasi' => $input['lokasi'],
            'tanggal' => $input['tanggal'],
            'jam' => $input['jam'],
        ];
        return $arrConf;
    }

    private function storeString($arrConf,$input)
    {
        $arrConf['lelang_config']['title']['id'] = $input['title_lelang_id'];
        $arrConf['lelang_config']['title']['en'] = $input['title_lelang_en'];
        $arrConf['location']['title']['id'] = $input['title_id'];
        $arrConf['location']['title']['en'] = $input['title_en'];
        $arrConf['location']['description']['id'] = $input['description_id'];
        $arrConf['location']['description']['en'] = $input['description_en'];
        $arrConf['location']['link'] = $input['link'];
        $arrConf['location']['embed'] = $input['embed'];
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
        $path_file = $dir_file.'contact_'.$input['for'].'_'.$input['key'].'_'.$input['img_name'];
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
