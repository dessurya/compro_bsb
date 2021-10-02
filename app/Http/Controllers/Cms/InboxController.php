<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Exports\InboxExport;
use Excel;

use App\Models\Inbox;

class InboxController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_inbox',
        'table_title' => 'List inbox',
        'table_url' => 'cms.inbox.list',
        'table_info' => null,
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
        'tools' => [
            [ 'label' => 'Export Data Table', 'function' => "exportInbox()" ]
        ]
    ];
    protected $paginate_default = 10;
    protected $cache_notify_inbox = 'newInboxCahce';

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
        Cache::forget($this->cache_notify_inbox);
        return response()->json(['response' => true, 'msg' => 'success']);
    }

    public function check()
    {
        $data = Cache::remember($this->cache_notify_inbox, 45, function () {
            return Inbox::where('flag_read', 'N')->orderBy('id','desc')->get();
        });

        $id = $data->pluck('id');
        $data = $data->take(3)->map(function($val,$key){
            $val->message = Str::words($val->message,18,'...');
            return $val;
        });
        return response()->json(['response' => true, 'id' => $id, 'data' => $data]);
    }

    public function export(Request $http_req)
    {
        $file_name = 'test-excel-inbox-'.$http_req->created_at_from.'-'.$http_req->created_at_to.'.xlsx';
        $condition = [
            'created_at_from' => $http_req->created_at_from,
            'created_at_to' => $http_req->created_at_to,
            'flag_read' => $http_req->flag_read,
            'email' => $http_req->email,
            'phone' => $http_req->phone,
            'subject' => $http_req->subject,
            'name' => $http_req->name,
        ];
        (new InboxExport($condition))->store($file_name);
        $files = Storage::get($file_name);
        $files = base64_encode($files);
        Storage::delete($file_name);
        return response()->json(['response' => true, 'encode_file' => $files, 'file_name' => $file_name]);
    }
}
