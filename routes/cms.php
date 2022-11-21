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

Route::get('/artisan-optimize', function(){
	\Artisan::call('optimize');
	dd('dun run artisan optimze');
});


Route::get('/', 'AuthController@redirectLogin');
Route::get('/login', 'AuthController@loginView')->name('login');
Route::post('/login', 'AuthController@loginExe')->name('loginexe');

Route::middleware('auth')->group(function(){
    Route::get('/log-out', 'AuthController@logOutExe')->name('logout');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    // public config
    Route::name('public-config')->prefix('public-config')->group(function(){
        Route::get('/', 'PublicConfigController@index');
        Route::post('/store', 'PublicConfigController@store')->name('.store');
    });
    // public config
    
    // navigation config
    Route::name('navigation-config')->prefix('navigation-config')->group(function(){
        Route::get('/', 'NavigationConfigController@index');
        Route::post('/list', 'NavigationConfigController@list')->name('.list');
        Route::post('/store', 'NavigationConfigController@store')->name('.store');
        Route::post('/store-flag-show', 'NavigationConfigController@storeFlagShow')->name('.store-flag-show');
    });
    // navigation config

    // page config
    Route::name('page-config.')->prefix('page-config')->group(function(){
        Route::name('home')->prefix('home')->group(function(){
            Route::get('/', 'PageConfigHomeController@index');
            Route::post('/store', 'PageConfigHomeController@store')->name('.store');
        });
        Route::name('about-us')->prefix('about-us')->group(function(){
            Route::get('/', 'PageConfigAboutUsController@index');
            Route::post('/store', 'PageConfigAboutUsController@store')->name('.store');
        });
        Route::name('our-product')->prefix('our-product')->group(function(){
            Route::get('/', 'PageConfigOurProductController@index');
            Route::post('/store', 'PageConfigOurProductController@store')->name('.store');
        });
        Route::name('sustainability')->prefix('sustainability')->group(function(){
            Route::get('/', 'PageConfigSustainabilityController@index');
            Route::post('/store', 'PageConfigSustainabilityController@store')->name('.store');
        });
        Route::name('our-client')->prefix('our-client')->group(function(){
            Route::get('/', 'PageConfigOurClientController@index');
            Route::post('/store', 'PageConfigOurClientController@store')->name('.store');
        });
        Route::name('news-info')->prefix('news-info')->group(function(){
            Route::get('/', 'PageConfigNewsInfoController@index');
            Route::post('/store', 'PageConfigNewsInfoController@store')->name('.store');
        });
        Route::name('investor')->prefix('investor')->group(function(){
            Route::get('/', 'PageConfigInvestorController@index');
            Route::post('/store', 'PageConfigInvestorController@store')->name('.store');
        });
        Route::name('career')->prefix('career')->group(function(){
            Route::get('/', 'PageConfigCareerController@index');
            Route::post('/store', 'PageConfigCareerController@store')->name('.store');
        });
        Route::name('contact-us')->prefix('contact-us')->group(function(){
            Route::get('/', 'PageConfigContactUsController@index');
            Route::post('/store', 'PageConfigContactUsController@store')->name('.store');
        });
    });
    // page config

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
        Route::post('/img', 'NewsInfoController@img')->name('.img');
        Route::post('/img/store', 'NewsInfoController@imgStore')->name('.img.store');
        Route::post('/img/delete', 'NewsInfoController@imgDelete')->name('.img.delete');
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

    // investor
    Route::name('investor')->prefix('investor')->group(function(){
        Route::get('/', 'InvestorController@index');
        Route::post('/list', 'InvestorController@list')->name('.list');
        Route::post('/open', 'InvestorController@open')->name('.open');
        Route::post('/store', 'InvestorController@store')->name('.store');
        Route::post('/store-img', 'InvestorController@storeImg')->name('.store-img');
        Route::post('/store-flag-publish', 'InvestorController@storeFlagPublish')->name('.store-flag-publish');
        Route::post('/delete', 'InvestorController@delete')->name('.delete');
    });
    // investor

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