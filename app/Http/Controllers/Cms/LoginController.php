<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {

    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        if (auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password' => $request->input('password')])){
            toastr()->info(__('site.cms.action.success_login'));
            return redirect(RouteServiceProvider::Admin);
        }else{
            toastr()->info(__('site.cms.action.error_login'));
            return redirect(route('admin.login'));
        }
    }
}
