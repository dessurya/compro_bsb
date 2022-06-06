<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Investor;

use HelperService;
use Auth;

class InvestorController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_investor',
        'table_title' => 'List Investor',
        'table_url' => 'cms.investor.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 4,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'id','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'name',  'label' => 'Name', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Investor', 'function' => "addInvestor()" ],
            [ 'label' => 'Publish/Hide Investor', 'function' => "publishInvestor()" ],
            [ 'label' => 'Delete Investor', 'function' => "deleteInvestor()" ],
        ]
    ];

    protected $paginate_default = 10;
    protected $module = 'Investor';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.investor.open'),
            'delete' => route('cms.investor.delete'),
            'store' => route('cms.investor.store'),
            'store-img' => route('cms.investor.store-img'),
            'store-flag-publish' => route('cms.investor.store-flag-publish'),
        ];
        return view('cms.page.investor', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Investor::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['name']) and !empty($http_req->condition['name'])){
            $data->where('name', 'like', '%'.$http_req->condition['name'].'%');
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Investor::find($http_req->id);
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
            'content_en'=>$http_req->content_en,
            'content_id'=>$http_req->content_id,
            'created_by'=>Auth::user()->name,
        ];
        $store = Investor::updateOrCreate($param_find,$param_store);
        HelperService::userHistoryStore($this->module,'Store Investor || '.json_encode($store));
        return response()->json([
            'response' => true,
            'msg'=> 'success',
            'id' => $store->id,
        ]);
    }

    public function storeImg(Request $http_req)
    {
        $find = Investor::find($http_req->set_id);
        if ($find and !empty($find->img)) { unlink($find->img); }
        $dir_estimate = 'pict_content_asset/investor';
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
        $find->img = $path_file;
        $find->save();
        return response()->json([
            'response' => true,
            'data' => $find,
            'http_req' => $http_req->input(),
        ]);
    }

    public function storeFlagPublish(Request $http_req)
    {
        $getData = Investor::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_publish == 'N') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish Investor || make publish : '.$row->name);
            }else if ($row->flag_publish == 'Y') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish Investor || make draft : '.$row->name);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function delete(Request $http_req)
    {
        $getData = Investor::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            HelperService::userHistoryStore($this->module,'Delete Investor || '.$row->name);
            if (!empty($row->img)) { unlink($row->img); }
            $row->delete();
        }
        return response()->json([ 'response' => true ]);
    }
}
