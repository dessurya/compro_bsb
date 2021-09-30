<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserHistory;

class UserHistoryController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_user_history',
        'table_title' => 'Activity List',
        'table_url' => 'cms.user-history.list',
        'table_info' => null,
        'data_field_count' => 5,
        'data_field_key' => null,
        'data_order' => ['field'=>'updated_at','value'=>'desc'],
        'data_set' => [
            [ 'label' => 'Module', 'order' => false, 'search' => true, 'search_type' => 'text' , 'field' => 'module' ],
            [ 'label' => 'Activity Date', 'order' => true, 'search' => false, 'field' => 'updated_at' ],
            [ 'label' => 'Name', 'order' => true, 'search' => true, 'search_type' => 'text' , 'field' => 'name' ],
            [ 'label' => 'Email', 'order' => true, 'search' => true, 'search_type' => 'text' , 'field' => 'email' ],
            [ 'label' => 'Activity', 'order' => false, 'search' => true, 'search_type' => 'text' , 'field' => 'activity' ],
        ],
        'tools' => []
    ];

    protected $paginate_default = 10;

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        return view('cms.page.user-history', compact(
            'table_config'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = UserHistory::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['key'], $order['value']);
        }
        if (isset($http_req->condition['name']) and !empty($http_req->condition['name'])){
            $data->where('name', 'like', '%'.$http_req->condition['name'].'%');
        }
        if (isset($http_req->condition['email']) and !empty($http_req->condition['email'])){
            $data->where('email', 'like', '%'.$http_req->condition['email'].'%');
        }
        if (isset($http_req->condition['module']) and !empty($http_req->condition['module'])){
            $data->where('module', 'like', '%'.$http_req->condition['module'].'%');
        }
        if (isset($http_req->condition['activity']) and !empty($http_req->condition['activity'])){
            $data->where('activity', 'like', '%'.$http_req->condition['activity'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }
}
