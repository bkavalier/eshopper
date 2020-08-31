<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
    	return view('admin.admin_dashboard');
    }
    public function login(Request $request){
    if($request->isMethod('post')){
    	$data = $request->all();
    	//echo "<pre>"; print_r($data); die;
    	$validatedData = $request->validate([
        	'email' => 'required|email|max:255',
               'password' => 'required',
    	]);
    	if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
 		return redirect('admin/dashboard');   	
    	}else{
    		Session::flash('error_message','Invalid email or password');
    		return redirect()->back();
    	     }
    	
    }
    	return view('admin.admin_login');
    }
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('/admin');
    }
}
