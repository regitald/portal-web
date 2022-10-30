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
        $login = $this->POST('http://103.214.112.156:3000/api/auth/login', $request->all());

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
}
