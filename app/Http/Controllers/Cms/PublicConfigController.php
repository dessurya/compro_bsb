<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PublicConfigController extends Controller
{
    public function index()
    {
        return [
            'storage_path' => storage_path(),
            'storage_path_1' => storage_path('config_json\public.json'),
        ];
        $files = Storage::get('config_json\public.json');
        return $files;
    }
}
