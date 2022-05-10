<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use File;

class PublicConfigController extends Controller
{
    public function index()
    {
        $files = File::get(storage_path('config_json/public.json'));
        // $files = Storage::get(storage_path('config_json/public.json'));
        return [
            'storage_path' => storage_path(),
            'storage_path_1' => storage_path('config_json/public.json'),
            'files' => $files
        ];
    }
}
