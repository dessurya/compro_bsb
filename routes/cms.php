<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Cms
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AuthController@redirectLogin');
Route::get('/login', 'AuthController@loginView')->name('login');
Route::post('/login', 'AuthController@loginExe')->name('loginexe');

Route::middleware('auth')->group(function(){
    Route::get('/log-out', 'AuthController@logOutExe')->name('logout');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    
    // user
    Route::name('user')->prefix('user')->group(function(){
        Route::get('/', 'UserController@index');
        Route::get('/profile', 'UserController@profile')->name('.profile');
        Route::post('/profile-update', 'UserController@profileUpdate')->name('.profile-update');
        
        Route::post('/list', 'UserController@list')->name('.list');
        Route::post('/submit-user', 'UserController@submitUser')->name('.submit-user');
        Route::post('/flag-active', 'UserController@flagActiveUser')->name('.flag-active');
        Route::post('/flag-notif-inbox', 'UserController@flagNotifInboxUser')->name('.flag-notif-inbox');
        Route::post('/reset-password', 'UserController@resetPasswordUser')->name('.reset-password');
    });
    // user

    // user history
    Route::name('user-history')->prefix('user-history')->group(function(){
        Route::get('/', 'UserHistoryController@index');
        Route::post('/list', 'UserHistoryController@list')->name('.list');
    });
    // user history
    
    // news info
    Route::name('news-info')->prefix('news-info')->group(function(){
        Route::get('/', 'NewsInfoController@index');
        Route::post('/list', 'NewsInfoController@list')->name('.list');
        Route::post('/open', 'NewsInfoController@open')->name('.open');
        Route::post('/store', 'NewsInfoController@store')->name('.store');
        Route::post('/store-img', 'NewsInfoController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'NewsInfoController@storeFlagPublish')->name('.store-flag-publish');
    });
    // news info

    // information
    Route::name('information')->prefix('information')->group(function(){
        Route::get('/', 'InformationController@index');
        Route::post('/list', 'InformationController@list')->name('.list');
        Route::post('/open', 'InformationController@open')->name('.open');
        Route::post('/store', 'InformationController@store')->name('.store');
        Route::post('/store-img', 'InformationController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'InformationController@storeFlagPublish')->name('.store-flag-publish');
        Route::post('/delete', 'InformationController@delete')->name('.delete');
    });
    // information

    // sustainability
    Route::name('sustainability')->prefix('sustainability')->group(function(){
        Route::get('/', 'SustainabilityController@index');
        Route::post('/list', 'SustainabilityController@list')->name('.list');
        Route::post('/open', 'SustainabilityController@open')->name('.open');
        Route::post('/store', 'SustainabilityController@store')->name('.store');
        Route::post('/store-img', 'SustainabilityController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'SustainabilityController@storeFlagPublish')->name('.store-flag-publish');
        Route::post('/delete', 'SustainabilityController@delete')->name('.delete');
    });
    // sustainability

    // management
    Route::name('management')->prefix('management')->group(function(){
        Route::get('/', 'ManagementController@index');
        Route::post('/list', 'ManagementController@list')->name('.list');
        Route::post('/open', 'ManagementController@open')->name('.open');
        Route::post('/store', 'ManagementController@store')->name('.store');
        Route::post('/store-img', 'ManagementController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'ManagementController@storeFlagPublish')->name('.store-flag-publish');
        Route::post('/delete', 'ManagementController@delete')->name('.delete');
    });
    // management

    // Product
    Route::name('product')->prefix('product')->group(function(){
        Route::get('/', 'ProductController@index');
        Route::post('/list', 'ProductController@list')->name('.list');
        Route::post('/open', 'ProductController@open')->name('.open');
        Route::post('/store', 'ProductController@store')->name('.store');
        Route::post('/store-img', 'ProductController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'ProductController@storeFlagPublish')->name('.store-flag-publish');
    });
    // Product

    // Banner
    Route::name('banner')->prefix('banner')->group(function(){
        Route::get('/', 'BannerController@index');
        Route::post('/list', 'BannerController@list')->name('.list');
        Route::post('/open', 'BannerController@open')->name('.open');
        Route::post('/store', 'BannerController@store')->name('.store');
        Route::post('/store-img', 'BannerController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'BannerController@storeFlagPublish')->name('.store-flag-publish');
        Route::post('/delete', 'BannerController@delete')->name('.delete');
    });
    // Banner

    // inbox
    Route::name('inbox')->prefix('inbox')->group(function(){
        Route::get('/', 'InboxController@index');
        Route::post('/list', 'InboxController@list')->name('.list');
        Route::post('/flag-read', 'InboxController@flagRead')->name('.flag-read');
        Route::post('/export', 'InboxController@export')->name('.export');
        Route::post('/check', 'InboxController@check')->name('.check');
    });
    // inbox
});