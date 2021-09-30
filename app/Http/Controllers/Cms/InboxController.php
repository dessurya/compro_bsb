<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inbox;

class InboxController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_inbox',
        'table_title' => 'List inbox',
        'table_url' => 'cms.inbox.list',
        'table_info' => '<small style="color:red">*For selected data, double click at a data row</small>',
        'data_field_count' => 7,
        'data_field_key' => 'email',
        'data_order' => ['field'=>'created_at','value'=>'desc'],
        'data_set' => [
            [ 'label' => 'Inbox Date', 'field' => 'created_at', 'order' => true, 'search' => true, 'search_type' => 'date' ],
            [ 'label' => 'Name', 'field' => 'name', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'label' => 'Email', 'field' => 'email', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'label' => 'Subject', 'field' => 'subject', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'label' => 'Phone', 'field' => 'phone', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'label' => 'Read', 'field' => 'flag_read', 'order' => true, 'search' => true, 'search_type' => 'text' ],
            [ 'label' => 'Tools', 'field' => 'tools', 'order' => false, 'search' => false ],
        ],
        'tools' => []
    ];
    protected $paginate_default = 10;

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        return view('cms.page.inbox', compact(
            'table_config'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = Inbox::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['key'], $order['value']);
        }
        if (isset($http_req->condition['name']) and !empty($http_req->condition['name'])){
            $data->where('name', 'like', '%'.$http_req->condition['name'].'%');
        }
        if (isset($http_req->condition['subject']) and !empty($http_req->condition['subject'])){
            $data->where('subject', 'like', '%'.$http_req->condition['subject'].'%');
        }
        if (isset($http_req->condition['phone']) and !empty($http_req->condition['phone'])){
            $data->where('phone', 'like', '%'.$http_req->condition['phone'].'%');
        }
        if (isset($http_req->condition['email']) and !empty($http_req->condition['email'])){
            $data->where('email', 'like', '%'.$http_req->condition['email'].'%');
        }
        if (isset($http_req->condition['flag_read']) and !empty($http_req->condition['flag_read'])){
            $data->where('flag_read', 'like', '%'.$http_req->condition['flag_read'].'%');
        }
        if (isset($http_req->condition['created_at_from']) and !empty($http_req->condition['created_at_from'])) {
            $data->whereDate('created_at', '>=', $http_req->condition['created_at_from']);
        }
        if (isset($http_req->condition['created_at_to']) and !empty($http_req->condition['created_at_to'])) {
            $data->whereDate('created_at', '<=', $http_req->condition['created_at_to']);
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function flagRead(Request $http_req)
    {
        Inbox::where('id',$http_req->id)->update(['flag_read' => 'Y']);
        return response()->json(['response' => true, 'msg' => 'success']);
    }
}
