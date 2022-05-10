<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NavigationConfig;

class NavigationConfigController extends Controller
{
    public function index()
    {
        $setData = [];
        return view('cms.page.navigation-config', compact(
            'setData'
        ));
    }

    public function list(Request $http_req)
    {
        $data = NavigationConfig::orderBy('position','asc')->get();
        return response()->json(['response' => true, 'data' => $data]);
    }
    
    public function storeFlagShow(Request $http_req)
    {
        $getData = NavigationConfig::whereIn('id',$http_req->ids)->get();
        foreach ($getData as $row) {
            if ($row->flag_show == 'N') {
                $row->update(['flag_show' => 'Y']);
            }else if ($row->flag_show == 'Y') {
                $row->update(['flag_show' => 'N']);
            }
        }
        return response()->json([
            'response' => true,
        ]);
    }

    public function store(Request $http_req)
    {
        $param_find = ['id'=>$http_req->id];
        $param_store = [
            'meta_author'=>$http_req->meta_author,
            'name'=>$http_req->name,
            'meta_description'=>$http_req->meta_description,
            'meta_keywords'=>$http_req->meta_keywords,
            'meta_title'=>$http_req->meta_title,
        ];
        $store = NavigationConfig::where($param_find)->update($param_store);
        return response()->json([
            'response' => true,
        ]);
    }
}
