<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
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
            session()->flash('flash_message', 'تمت عملية تسجيل الدخول بنجاح');
            return redirect(route('dashboard.index'));
        }else{
            session()->flash('flash_message', 'كلمة السر أو الإيميل خطأ');
            return redirect(route('getLogin'));
        }
    }
}
