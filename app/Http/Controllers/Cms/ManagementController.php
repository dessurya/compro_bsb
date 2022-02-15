<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Management;

use HelperService;
use Auth;

class ManagementController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_management',
        'table_title' => 'List Management',
        'table_url' => 'cms.management.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 7,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'position','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'name',  'label' => 'Name', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'job_title_en',  'label' => 'Job Title En', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'job_title_id',  'label' => 'Job Title Id', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'position',  'label' => 'Position', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Management', 'function' => "addManagement()" ],
            [ 'label' => 'Publish/Hide Management', 'function' => "publishManagement()" ],
            [ 'label' => 'Delete Management', 'function' => "deleteManagement()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $module = 'Management';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.management.open'),
            'delete' => route('cms.management.delete'),
            'store' => route('cms.management.store'),
            'store-img' => route('cms.management.store-img'),
            'store-flag-publish' => route('cms.management.store-flag-publish'),
        ];
        return view('cms.page.management', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Management::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['name']) and !empty($http_req->condition['name'])){
            $data->where('name', 'like', '%'.$http_req->condition['name'].'%');
        }
        if (isset($http_req->condition['position']) and !empty($http_req->condition['position'])){
            $data->where('position', $http_req->condition['position']);
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        if (isset($http_req->condition['job_title_en']) and !empty($http_req->condition['job_title_en'])){
            $data->where('job_title_en', 'like', '%'.$http_req->condition['job_title_en'].'%');
        }
        if (isset($http_req->condition['job_title_id']) and !empty($http_req->condition['job_title_id'])){
            $data->where('job_title_id', 'like', '%'.$http_req->condition['job_title_id'].'%');
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Management::find($http_req->id);
        return response()->json([
            'response' => true,
            'data' => $data
        ]);
    }

    public function store(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'name'=>$http_req->name,
            'queues'=>$http_req->queues,
            'job_title_en'=>$http_req->job_title_en,
            'job_title_id'=>$http_req->job_title_id,
            'created_by'=>Auth::user()->name,
            'quotes_en'=>$http_req->quotes_en,
            'quotes_id'=>$http_req->quotes_id,
            'text_en'=>$http_req->text_en,
            'text_id'=>$http_req->text_id,
        ];
        $store = Management::updateOrCreate($param_find,$param_store);
        HelperService::userHistoryStore($this->module,'Store Founder || '.json_encode($store));
        return response()->json([
            'response' => true,
            'msg'=> 'success',
            'id' => $store->id,
        ]);
    }

    public function storeImg(Request $http_req)
    {
        $find = Management::find($http_req->set_id);
        if ($find and !empty($find->img)) {
            unlink($find->img);
        }
        $dir_estimate = 'pict_content_asset/management';
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
        $param_store = [ 'img' => $path_file ];
        $store = Management::updateOrCreate($param_find,$param_store);
        return response()->json([
            'response' => true
        ]);
    }

    public function storeFlagPublish(Request $http_req)
    {
        $getData = Management::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_publish == 'N') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish Management || make publish : '.$row->name);
            }else if ($row->flag_publish == 'Y') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish Management || make draft : '.$row->name);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function delete(Request $http_req)
    {
        $getData = Management::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            HelperService::userHistoryStore($this->module,'Delete Management || '.$row->name);
            if (!empty($row->img)) { unlink($row->img); }
            $row->delete();
        }
        return response()->json([ 'response' => true ]);
    }
}
