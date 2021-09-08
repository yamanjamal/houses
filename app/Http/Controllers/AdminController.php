<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AdminController extends Controller
{
   
    public function check(AdminLoginRequest $request)
    {
        $cred=$request->only('email','password');
        if (Auth::guard('admin')->attempt($cred)) {
            return redirect()->route('admin.home')->with(['success' => 'admin loggedin seccessfuly']);
        }else{
            return 
            redirect()->route('admin.login')->with(['ERORR' => 'the info is not correct']);
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
