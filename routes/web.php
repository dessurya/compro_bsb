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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'AboutUsController@index')->name('about-us');
Route::get('/our-product', 'OurProductController@index')->name('our-product');
Route::get('/our-client', 'OurClientController@index')->name('our-client');
Route::get('/investor', 'InvestorController@index')->name('investor');
Route::get('/sustainability', 'SustainabilityController@index')->name('sustainability');
Route::get('/news-info', 'NewsInfoController@index')->name('news-info');
Route::get('/news-info/{slug}', 'NewsInfoController@detail')->name('news-info.detail');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@store')->name('contact.store');
Route::get('/language-change', 'HomeController@changeLanguage')->name('language.change');
