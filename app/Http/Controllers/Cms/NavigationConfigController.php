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
}
