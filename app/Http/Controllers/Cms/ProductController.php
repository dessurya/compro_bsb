<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use Validator;
use HelperService;
use Auth;

class ProductController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_product',
        'table_title' => 'List Product',
        'table_url' => 'cms.product.list',
        'table_info' => '*double click for selected row data',
        'data_field_count' => 6,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'position','value'=>'asc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'title',  'label' => 'Title', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'position',  'label' => 'Position', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'language',  'label' => 'Bahasa', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add Product', 'function' => "addProduct()" ],
            [ 'label' => 'Publish Product', 'function' => "publishProduct()" ],
            [ 'label' => 'Back To Draft', 'function' => "draftProduct()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $module = 'Product';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'open' => route('cms.product.open'),
            'store' => route('cms.product.store'),
            'store-img' => route('cms.product.store-img'),
            'store-flag-publish' => route('cms.product.store-flag-publish'),
        ];
        return view('cms.page.product', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Product::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['title']) and !empty($http_req->condition['title'])){
            $data->where('title', 'like', '%'.$http_req->condition['title'].'%');
        }
        if (isset($http_req->condition['language']) and !empty($http_req->condition['language'])){
            $data->where('language', 'like', '%'.$http_req->condition['language'].'%');
        }
        if (isset($http_req->condition['created_by']) and !empty($http_req->condition['created_by'])){
            $data->where('created_by', 'like', '%'.$http_req->condition['created_by'].'%');
        }
        if (isset($http_req->condition['position']) and !empty($http_req->condition['position'])){
            $data->where('position', $http_req->condition['position']);
        }
        if (isset($http_req->condition['flag_publish']) and !empty($http_req->condition['flag_publish'])){
            $data->where('flag_publish', $http_req->condition['flag_publish']);
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function open(Request $http_req)
    {
        $data = Product::find($http_req->id);
        return response()->json([
            'response' => true,
            'data' => $data
        ]);
    }

    private function validateStore($http_req,$rule_validate)
    {
        $result = [
            'response' => true,
            'msg'=> 'success',
        ];
        $message = [];
        $validator = Validator::make($http_req, $rule_validate, $message);
        if ($validator->fails()) {
            $result['response'] = false;
            $result['notif_type'] = 'error';
            $result['msg'] = 'fail';
            $result['invalid'] = $validator->getMessageBag()->toArray();
        }
        return $result;
    }

    public function store(Request $http_req)
    {
        $rule_validate = [ 'title' => 'required|max:175|unique:product,title', ];
        if (!empty($http_req->id)) { $rule_validate['title'] .= ','.$http_req->id; }
        $result = $this->validateStore($http_req->input(),$rule_validate);
        if ($result['response'] == true) {
            $param_find = ['id'=>$http_req->id];
            $param_store = [
                'title'=>$http_req->title,
                'slug'=>$http_req->title,
                'position'=>$http_req->position,
                'created_by'=>Auth::user()->name,
                'language'=>$http_req->language,
                'content'=>$http_req->content,
                'content_shoert'=>$http_req->content_shoert,
            ];
            $store = Product::updateOrCreate($param_find,$param_store);
            HelperService::userHistoryStore($this->module,'Store Product || '.json_encode($store));
            $result['id'] = $store->id;
        }
        return response()->json($result);
    }

    public function storeImg(Request $http_req)
    {
        $find = Product::find($http_req->set_id);
        if ($find) {
            if ($http_req->for == 'thumnail' and !empty($find->img_thumnail)) { unlink($find->img_thumnail); }
            else if ($http_req->for == 'banner' and !empty($find->img_banner)) { unlink($find->img_banner); }
        }
        $dir_estimate = 'pict_content_asset/product';
        $dir_file = '';
        foreach (explode('/',$dir_estimate) as $item) {
            $dir_file .= $item.'/';
            if (!file_exists($dir_file)){ mkdir($dir_file, 0777); }
        }
        $path_file = $dir_file.$http_req->for.'_'.$http_req->name;
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
        
        if ($http_req->for == 'thumbnail') { $param_store = [ 'img_thumnail' => $path_file ]; }
        else if ($http_req->for == 'banner') { $param_store = [ 'img_banner' => $path_file ]; }
        
        $store = Product::updateOrCreate($param_find,$param_store);
        return response()->json([
            'response' => true
        ]);
    }

    public function storeFlagPublish(Request $http_req)
    {
        $getData = Product::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_publish == 'N' AND $http_req->status == 'Y') {
                $row->update(['flag_publish' => 'Y']);
                HelperService::userHistoryStore($this->module,'Publish Product || make publish : '.$row->slug);
            }else if ($row->flag_publish == 'Y' AND $http_req->status == 'N') {
                $row->update(['flag_publish' => 'N']);
                HelperService::userHistoryStore($this->module,'Publish Product || make draft : '.$row->slug);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }
}
