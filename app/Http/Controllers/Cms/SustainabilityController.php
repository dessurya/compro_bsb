<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sustainability;

use HelperService;
use Auth;

class SustainabilityController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_sustainability',
        'table_title' => 'List Sustainability',
        'table_url' => 'cms.sustainability.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 7,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'language','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'language',  'label' => 'Bahasa', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'title',  'label' => 'Judul', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'position',  'label' => 'Position', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'content_shoert',  'label' => 'Deskripsi', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Sustainability', 'function' => "addSustainability()" ],
            [ 'label' => 'Publish/Hide Sustainability', 'function' => "publishSustainability()" ],
            [ 'label' => 'Delete Sustainability', 'function' => "deleteSustainability()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $module = 'Sustainability';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.sustainability.open'),
            'delete' => route('cms.sustainability.delete'),
            'store' => route('cms.sustainability.store'),
            'store-img' => route('cms.sustainability.store-img'),
            'store-flag-publish' => route('cms.sustainability.store-flag-publish'),
        ];
        return view('cms.page.sustainability', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Sustainability::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['title']) and !empty($http_req->condition['title'])){
            $data->where('title', 'like', '%'.$http_req->condition['title'].'%');
        }
        if (isset($http_req->condition['position']) and !empty($http_req->condition['position'])){
            $data->where('position', $http_req->condition['position']);
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        if (isset($http_req->condition['language']) and !empty($http_req->condition['language'])){
            $data->where('language', 'like', '%'.$http_req->condition['language'].'%');
        }
        if (isset($http_req->condition['content_shoert']) and !empty($http_req->condition['content_shoert'])){
            $data->where('content_shoert', 'like', '%'.$http_req->condition['content_shoert'].'%');
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Sustainability::find($http_req->id);
        return response()->json([
            'response' => true,
            'data' => $data
        ]);
    }

    public function store(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'title'=>$http_req->title,
            'position'=>$http_req->position,
            'language'=>$http_req->language,
            'content_shoert'=>$http_req->content_shoert,
            'created_by'=>Auth::user()->name,
        ];
        $store = Sustainability::updateOrCreate($param_find,$param_store);
        HelperService::userHistoryStore($this->module,'Store Sustainability || '.json_encode($store));
        return response()->json([
            'response' => true,
            'msg'=> 'success',
            'id' => $store->id,
        ]);
    }

    public function storeImg(Request $http_req)
    {
        $find = Sustainability::find($http_req->set_id);
        if ($find and !empty($find->img_thumnail)) {
            unlink($find->img_thumnail);
        }
        $dir_estimate = 'pict_content_asset/sustainability';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.$http_req->name;
        try {
            file_put_contents($path_file, base64_decode($http_req->encode));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            return response()->json([
                'response' => false,
                'http_req' => $msg
            ]);
        }
        $param_find = ['id'=>$http_req->set_id];
        $param_store = [ 'img_thumnail' => $path_file ];
        $store = Sustainability::updateOrCreate($param_find,$param_store);
        return response()->json([
            'response' => true
        ]);
    }
    
    public function storeFlagPublish(Request $http_req)
    {
        $getData = Sustainability::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_publish == 'N') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish Sustainability || make publish : '.$row->slug);
            }else if ($row->flag_publish == 'Y') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish Sustainability || make draft : '.$row->slug);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function delete(Request $http_req)
    {
        $getData = Sustainability::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if (!empty($row->img_thumnail)) { unlink($row->img_thumnail); }
            $row->delete();
        }
        return response()->json([ 'response' => true ]);
    }
}