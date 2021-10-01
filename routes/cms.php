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
    
    // inbox
    Route::name('inbox')->prefix('inbox')->group(function(){
            Route::get('/', 'InboxController@index');
            Route::post('/list', 'InboxController@list')->name('.list');
            Route::post('/flag-read', 'InboxController@flagRead')->name('.flag-read');
            Route::post('/check', 'InboxController@check')->name('.check');
        });
    // inbox
});