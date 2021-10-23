<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator;
use HelperService;
use Auth;
use Hash;

class UserController extends Controller
{
    protected $table_config = [
        'table_id' => 'list_user',
        'table_title' => 'List User',
        'table_url' => 'cms.user.list',
        'table_info' => '<small style="color:red">*For selected data, double click at a data row</small>',
        'data_field_count' => 6,
        'data_field_key' => 'email',
        'data_order' => ['field'=>'name','value'=>'asc'],
        'data_set' => [
            [ 'label' => 'Name', 'order' => true, 'search' => true, 'search_type' => 'text' , 'field' => 'name' ],
            [ 'label' => 'Email', 'order' => true, 'search' => true, 'search_type' => 'text' , 'field' => 'email' ],
            [ 'label' => 'Active', 'order' => false, 'search' => true, 'search_type' => 'text' , 'field' => 'flag_active' ],
            [ 'label' => 'Notif Inbox', 'order' => false, 'search' => true, 'search_type' => 'text' , 'field' => 'flag_notif_inbox' ],
            [ 'label' => 'Modify Date', 'order' => true, 'search' => false, 'field' => 'updated_at' ],
            [ 'label' => 'Tools', 'order' => false, 'search' => false, 'field' => 'tools' ],
        ],
        'tools' => [
            [ 'label' => 'Add User', 'function' => "addUser()" ],
            [ 'label' => 'Activated/Deactivated User', 'function' => "flagActiveUser()" ],
            [ 'label' => 'Activated/Deactivated Notif Inbox User', 'function' => "flagNotifInboxUser()" ],
            [ 'label' => 'Reset Password', 'function' => "resetPasswordUser()" ],
        ]
    ];
    protected $paginate_default = 10;
    protected $default_password = 'opencms123';
    protected $module = 'User Management';

    public function index()
    {
        $table_config = $this->table_config;
        $table_config['table_url'] = route($table_config['table_url']);
        $http_req = [
            'submit-user' => route('cms.user.submit-user'),
            'reset-password' => route('cms.user.reset-password'),
            'flag-active' => route('cms.user.flag-active'),
            'flag-notif-inbox' => route('cms.user.flag-notif-inbox'),
        ];
        return view('cms.page.user-management', compact(
            'table_config', 'http_req'
        ));
    }

    public function list(Request $http_req)
    {
        $table_config = $this->table_config;
        $paginate = $this->paginate_default;
        if (isset($http_req->show) and !empty($http_req->show)) { $paginate = $http_req->show; }

        $data = User::select('*');
        if (isset($http_req->order_key) and !empty($http_req->order_key)) {
            $data->orderBy($http_req->order_key, $http_req->order_val);
        }else{
            $order = $table_config['data_order'];
            $data->orderBy($order['field'], $order['value']);
        }
        if (isset($http_req->condition['name']) and !empty($http_req->condition['name'])){
            $data->where('name', 'like', '%'.$http_req->condition['name'].'%');
        }
        if (isset($http_req->condition['email']) and !empty($http_req->condition['email'])){
            $data->where('email', 'like', '%'.$http_req->condition['email'].'%');
        }
        if (isset($http_req->condition['flag_active']) and !empty($http_req->condition['flag_active'])){
            $data->where('flag_active', 'like', '%'.$http_req->condition['flag_active'].'%');
        }
        $data = $data->paginate($paginate);
        return response()->json(['response' => true, 'data' => $data]);
    }

    public function submitUser(Request $http_req)
    {
        $result = $this->submitUserValidate($http_req->input());
        if ($result['response'] == true) {
            $param_find = ['id'=>$http_req->id];
            $param_store = ['email'=>$http_req->email,'name'=>$http_req->name];
            $store = User::updateOrCreate($param_find,$param_store);
            HelperService::userHistoryStore($this->module,'Store user || '.json_encode($store));
        }
        return response()->json($result);
    }

    private function submitUserValidate($http_req)
    {
        $result = [
            'response' => true,
            'msg'=> 'success',
        ];
        $message = [];
        $rule_validate = [
            'name' => 'required|max:175',
            'email' => 'required|max:175|unique:users,email',
        ];
        if (!empty($http_req['id'])) { $rule_validate['email'] .= ','.$http_req['id']; }
        $validator = Validator::make($http_req, $rule_validate, $message);
        if ($validator->fails()) {
            $result['response'] = false;
            $result['notif_type'] = 'error';
            $result['msg'] = 'fail';
            $result['invalid'] = $validator->getMessageBag()->toArray();
        }
        return $result;
    }

    public function flagActiveUser(Request $http_req)
    {
        foreach ($http_req->ids as $val_id) {
            $store = User::find($val_id);
            $store->flag_active = $store->flag_active == 'Y' ? 'N' : 'Y';
            $store->save();
            $record_history = [
                'name' => $store->name,
                'email' => $store->email,
                'flag_active' => $store->flag_active,
            ];
            HelperService::userHistoryStore($this->module,'Update flag active || '.json_encode($record_history));
        }
        return response()->json([
            'response' => true,
            'msg'=> 'success'
        ]);
    }

    public function flagNotifInboxUser(Request $http_req)
    {
        foreach ($http_req->ids as $val_id) {
            $store = User::find($val_id);
            $store->flag_notif_inbox = $store->flag_notif_inbox == 'Y' ? 'N' : 'Y';
            $store->save();
            $record_history = [
                'name' => $store->name,
                'email' => $store->email,
                'flag_notif_inbox' => $store->flag_notif_inbox,
            ];
            HelperService::userHistoryStore($this->module,'Update flag notif inbox || '.json_encode($record_history));
        }
        return response()->json([
            'response' => true,
            'msg'=> 'success'
        ]);
    }

    public function resetPasswordUser(Request $http_req)
    {
        foreach ($http_req->ids as $val_id) {
            $store = User::find($val_id);
            $store->password = $this->default_password;
            $store->save();
            $record_history = [
                'name' => $store->name,
                'email' => $store->email,
            ];
            HelperService::userHistoryStore($this->module,'Reset password || '.json_encode($record_history));
        }
        return response()->json([
            'response' => true,
            'msg'=> 'success'
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('cms.page.user-profile', compact('user'));
    }

    public function profileUpdate(Request $http_req)
    {
        $user = User::find(Auth::user()->id);
        $message = [];
        $validator = Validator::make($http_req->all(), [
                'name' => 'required|max:175',
                'email' => 'required|max:175|unique:users,email,'.$user->id,
        ], $message);
        if ($validator->fails()) { 
            $result = [
                'store' => false,
                'alert' => 'error',
                'validator' => $validator->getMessageBag()->toArray()
            ];
            return redirect()->back()->with('status', base64_encode(json_encode($result))); 
        }
        if (!Hash::check($http_req->current_password, $user->password)){ 
            $result = [
                'store' => false,
                'alert' => 'error',
                'validator' => [ 'Current Password' => 'Fail, your current password not correct!' ]
            ];
            return redirect()->back()->with('status', base64_encode(json_encode($result))); 
        }
        if (!empty($http_req->new_password) or !empty($http_req->confirm_new_password)) {
            if($http_req->new_password != $http_req->confirm_new_password){ 
                $result = [
                    'store' => false,
                    'alert' => 'error',
                    'validator' => [ 'Confirm New Password' => 'Fail, confirm new password not correct!' ]
                ];
                return redirect()->back()->with('status', base64_encode(json_encode($result))); 
            }
            $user->password = $http_req->new_password;
        }
        $user->email = $http_req->email;
        $user->name = $http_req->name;
        $user->save();
        $result = [
            'store' => true,
            'alert' => 'success',
            'validator' => [ 'Success' => 'update your data!' ]
        ];
        return redirect()->back()->with('status', base64_encode(json_encode($result))); 
    }
}
