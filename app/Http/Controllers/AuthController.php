<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class AuthController extends Controller
{
    use GeneralServices;
    public function index(Request $request){
        $data['title'] = 'Admin';
        return view('admin.login',$data);
    }

    public function login(Request $request)
    {
        $role = [
            'username' => 'Required',
            'password' => 'Required',
        ];

        $validateData = $this->ValidateRequest($request->all(), $role);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        $login = $this->POST('http://localhost:3000/api/auth/login', $request->all());

        if($login['status'] != 200) {
            return redirect()->back()->withErrors($login['message']);
        }
        Session::put('Users',$login['content']);
        // dd(Session::get('Users')['permissions']);

        return redirect('/admin/dashboard');
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }

    public function user(Request $request){
        $data['title'] = 'Request Account';
        return view('admin.user',$data);
    }

    public function store(Request $request)
    {
        $user = $this->POST('http://localhost:3000/api/users', $request->all());

        if($user['message'] != 'success') {
            return redirect()->back()->withErrors($user['message']);
        }

        return redirect('/')->with('success', "Account Created!");
    }
}
