<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsInfo;

use HelperService;
use Auth;

class NewsInfoController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_news_info',
        'table_title' => 'List News Info',
        'table_url' => 'cms.news-info.list',
        'table_info' => null,
        'data_field_count' => 7,
        'data_field_key' => 'id',
        'data_order' => ['field'=>'created_at','value'=>'desc'],
        'data_set' => [
            [ 'field' => 'tools',  'label' => 'Tools', 'order' => false, 'search' => false ],
            [ 'field' => 'title',  'label' => 'Judul', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'language',  'label' => 'Bahasa', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_at',  'label' => 'Tanggal Pembuatan', 'order' => true, 'search' => true, 'search_type' => 'date' ],
            [ 'field' => 'publish_date',  'label' => 'Tanggal Publish', 'order' => true, 'search' => true, 'search_type' => 'date' ],
            [ 'field' => 'flag_publish',  'label' => 'Publish', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'field' => 'created_by',  'label' => 'Ditulis Oleh', 'order' => true, 'search' => true, 'search_type' => 'text' ],
        ],
        'tools' => [
            [ 'label' => 'Add News/Info', 'function' => "addNewsInfo()" ],
            [ 'label' => 'Publish News/Info', 'function' => "publishNewsInfo()" ],
            [ 'label' => 'Kembalikan Ke Draft', 'function' => "backToDraftNewsInfo()" ],
        ]
    ];
    protected $paginate_default = 10;

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'store-part-one' => route('cms.news-info.store-part-one'),
            'store-img' => route('cms.news-info.store-img'),
        ];
        return view('cms.page.news-info', compact(
            'table_config'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = NewsInfo::select('*');
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
        if (isset($http_req->condition['created_at_from']) and !empty($http_req->condition['created_at_from'])) {
            $data->whereDate('created_at', '>=', $http_req->condition['created_at_from']);
        }
        if (isset($http_req->condition['created_at_to']) and !empty($http_req->condition['created_at_to'])) {
            $data->whereDate('created_at', '<=', $http_req->condition['created_at_to']);
        }
        if (isset($http_req->condition['publish_date_from']) and !empty($http_req->condition['publish_date_from'])) {
            $data->whereDate('publish_date', '>=', $http_req->condition['publish_date_from']);
        }
        if (isset($http_req->condition['publish_date_to']) and !empty($http_req->condition['publish_date_to'])) {
            $data->whereDate('publish_date', '<=', $http_req->condition['publish_date_to']);
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function storePartOne(Request $http_req)
    {
        $rule_validate = [ 'title' => 'required|max:175|unique:news_info,title', ];
        if (!empty($http_req->id)) { $rule_validate['title'] .= ','.$http_req->id; }
        $result = $this->validateStore($http_req->input(),$rule_validate);
        if ($result['response'] == true) {
            $param_find = ['id'=>$http_req->id];
            $param_store = [
                'title'=>$http_req->title,
                'publish_date'=>$http_req->publish_date,
                'language'=>$http_req->language,
                'flag_img'=>$http_req->flag_img,
            ];
            $store = NewsInfo::updateOrCreate($param_find,$param_store);
            HelperService::userHistoryStore($this->module,'Store news & info || '.json_encode($store));
            $result['id'] = $store->id;
        }
        return response()->json($result);
    }

    public function storeImg(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'title'=>$http_req->title,
            'publish_date'=>$http_req->publish_date,
            'language'=>$http_req->language,
            'flag_img'=>$http_req->flag_img,
        ];
        $store = NewsInfo::updateOrCreate($param_find,$param_store);
        return response()->json([
            'response' => true
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
}
