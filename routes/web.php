<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $locale = App::currentLocale();
    return response()->json([
        'res' => true,
        'locale' => $locale
    ]);
});

Route::get('/set-language/{locale}', function ($locale) {
    if (array_key_exists($locale, Config::get('language'))) {
        Session::put('applocale', $locale);
    }
    return Redirect::back();
});
