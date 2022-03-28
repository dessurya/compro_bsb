<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

use HelperService;
use Auth;

class BannerController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_Banner',
        'table_title' => 'List Banner',
        'table_url' => 'cms.banner.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 7,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'queues','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'queues',  'label' => 'Queues', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'text',  'label' => 'Text', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'title',  'label' => 'Title', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'link',  'label' => 'Link', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Banner', 'function' => "addBanner()" ],
            [ 'label' => 'Publish/Hide Banner', 'function' => "publishBanner()" ],
            [ 'label' => 'Delete Banner', 'function' => "deleteBanner()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $module = 'Banner';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.banner.open'),
            'delete' => route('cms.banner.delete'),
            'store' => route('cms.banner.store'),
            'store-img' => route('cms.banner.store-img'),
            'store-flag-publish' => route('cms.banner.store-flag-publish'),
        ];
        return view('cms.page.banner', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Banner::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['text']) and !empty($http_req->condition['text'])){
            $data->where('text', 'like', '%'.$http_req->condition['text'].'%');
        }
        if (isset($http_req->condition['queues']) and !empty($http_req->condition['queues'])){
            $data->where('queues', $http_req->condition['queues']);
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        if (isset($http_req->condition['title']) and !empty($http_req->condition['title'])){
            $data->where('title', 'like', '%'.$http_req->condition['title'].'%');
        }
        if (isset($http_req->condition['link']) and !empty($http_req->condition['link'])){
            $data->where('link', 'like', '%'.$http_req->condition['link'].'%');
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Banner::find($http_req->id);
        return response()->json([
            'response' => true,
            'data' => $data
        ]);
    }

    public function store(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'text'=>$http_req->text,
            'queues'=>$http_req->queues,
            'title'=>$http_req->title,
            'description'=>$http_req->description,
            'created_by'=>Auth::user()->name,
            'link'=>$http_req->link,
        ];
        $store = Banner::updateOrCreate($param_find,$param_store);
        HelperService::userHistoryStore($this->module,'Store Founder || '.json_encode($store));
        return response()->json([
            'response' => true,
            'msg'=> 'success',
            'id' => $store->id,
        ]);
    }

    public function storeFlagPublish(Request $http_req)
    {
        $getData = Banner::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_publish == 'N') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish Banner || make publish : '.$row->title);
            }else if ($row->flag_publish == 'Y') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish Banner || make draft : '.$row->title);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function delete(Request $http_req)
    {
        $getData = Banner::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            HelperService::userHistoryStore($this->module,'Delete Banner || '.$row->title);
            if (!empty($row->img)) { unlink($row->img); }
            $row->delete();
        }
        return response()->json([ 'response' => true ]);
    }

    public function storeImg(Request $http_req)
    {
        $find = Banner::find($http_req->set_id);
        if ($find and !empty($find->img)) { unlink($find->img); }
        $dir_estimate = 'pict_content_asset/banner';
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
}
