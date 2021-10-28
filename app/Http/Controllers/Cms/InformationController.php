<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;

use Validator;
use HelperService;
use Auth;

class InformationController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_information',
        'table_title' => 'List Information',
        'table_url' => 'cms.information.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 6,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'type','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'type',  'label' => 'Type', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'content',  'label' => 'Content', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'position',  'label' => 'Position', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Information', 'function' => "addInformation()" ],
            [ 'label' => 'Publish/Hide Information', 'function' => "publishInformation()" ],
            [ 'label' => 'Delete Information', 'function' => "deleteInformation()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $module = 'Information';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.information.open'),
            'delete' => route('cms.information.delete'),
            'store' => route('cms.information.store'),
            'store-img' => route('cms.information.store-img'),
            'store-flag-publish' => route('cms.information.store-flag-publish'),
        ];
        return view('cms.page.information', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Information::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['type']) and !empty($http_req->condition['type'])){
            $data->where('type', 'like', '%'.$http_req->condition['type'].'%');
        }
        if (isset($http_req->condition['position']) and !empty($http_req->condition['position'])){
            $data->where('position', $http_req->condition['position']);
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        if (isset($http_req->condition['content']) and !empty($http_req->condition['content'])){
            $data->where('content', 'like', '%'.$http_req->condition['content'].'%');
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Information::find($http_req->id);
        return response()->json([
            'response' => true,
            'data' => $data
        ]);
    }

    public function store(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'type'=>$http_req->type,
            'position'=>$http_req->position,
            'content'=>$http_req->content,
            'created_by'=>Auth::user()->name,
        ];
        $store = Information::updateOrCreate($param_find,$param_store);
        HelperService::userHistoryStore($this->module,'Store information || '.json_encode($store));
        $result['id'] = $store->id;
        return response()->json($result);
    }

    public function storeImg(Request $http_req)
    {
        $find = Information::find($http_req->set_id);
        if ($find and !empty($find->img)) {
            unlink($find->img);
        }
        $dir_estimate = 'pict_content_asset/information/';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.$find->type.'_'.$http_req->name;
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
        $param_store = [ 'img' => $path_file ];
        $store = Information::updateOrCreate($param_find,$param_store);
        return response()->json([
            'response' => true
        ]);
    }

    public function storeFlagPublish(Request $http_req)
    {
        $getData = Information::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($http_req->status == 'Y' and $row->flag_publish == 'N') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish information || make publish : '.$row->slug);
            }else if ($http_req->status == 'N' and $row->flag_publish == 'Y') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish information || make draft : '.$row->slug);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function delete(Request $http_req)
    {
        $find = Information::find($http_req->id);
        if ($find and !empty($find->img)) {
            unlink($find->img);
            $find->delete();
            return response()->json([ 'response' => true ]);
        }
        return response()->json([ 'response' => false ]);
    }
}
