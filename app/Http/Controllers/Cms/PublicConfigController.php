<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use File;

class PublicConfigController extends Controller
{
    public function index()
    {
        $files = File::get('\storage\config_json\public.json');
        return $files;
    }
}
