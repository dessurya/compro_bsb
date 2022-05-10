<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PublicConfigController extends Controller
{
    public function index()
    {
        $files = Storage::get(public_path());
        return $files;
    }
}
