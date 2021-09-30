<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logOutExe');
    }

    public function redirectLogin() { return redirect()->route('cms.login'); }

    public function loginView()
    {
        if (auth()->check()) { return redirect()->route('cms.dashboard'); }
        return view('cms.login');
    }

    public function loginExe(Request $http_req)
    {
        if (Auth::attempt(['email' => $http_req->email, 'password' => $http_req->password ])){
            return redirect()->route('cms.dashboard');
        }
        return redirect()->back()->with('status', 'Sorry not found your account or please check your password');
    }

    public function logOutExe()
    {
        auth()->logout();
        return redirect()->route('cms.login');
    }

}
