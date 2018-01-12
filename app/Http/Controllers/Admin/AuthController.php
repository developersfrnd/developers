<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Config;
use Session;
use Auth;

class AuthController extends AdminController
{
    public function getLogin()
	{ 
		if (Auth::check()) {
			// Logged in, go to the dashboard
			return redirect($this->ADMIN_URL.'/dashboard');
		}

		return view('admin.auth.login');
	}

	public function postLogin(){
		$credentials = array('email'=>Input::get('email'),'password'=>Input::get('password'));
		if(Auth::attempt($credentials)){
			return redirect($this->ADMIN_URL.'/dashboard');
		}else{
			return back()->withInput();
		}
	}

	public function dashboard(){
		$categories_count = \App\Category::all()->count();
		$blogs_count = \App\Blog::all()->count();
		$users_count = \App\User::all()->count();
		return view('admin.auth.dashboard',compact('categories_count','blogs_count','users_count'));
	}

	public function logout(){
		Auth::logout();
		return redirect('/'.$this->ADMIN_URL);
	}
}
