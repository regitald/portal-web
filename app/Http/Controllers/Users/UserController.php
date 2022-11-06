<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\Admin\UsersModel;
use App\Models\Admin\UserRolesModel;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    use GeneralServices;
    public function profileDetail(Request $request){

        $user = $this->GET('http://localhost:3000/api/users');
        $data['title'] = 'Manage User';
        $data['contoh'] = $this->GET('http://localhost:3000/api/users')['content'];
        return view('admin.profile.view',$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data['title'] = 'Manage Users';
        return view('admin.user.add',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->POST('http://localhost:3000/api/users', $request->all());

        if($user['message'] != 'success') {
            return redirect()->back()->withErrors($user['message']);
        }

        return redirect('admin/profile')->with('success', "Account Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['title'] = 'Edit Users';
        $data['data'] = $this->GET('http://localhost:3000/api/users/'.$id)['content'];
        return view('admin.user.edit',$data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $user = $this->PUT('http://localhost:3000/api/users/'.$request['id'], $request->all());

        if($user['message'] != 'success') {
            return redirect()->back()->withErrors($user['message']);
        }

        return redirect('admin/profile')->with('success', "Account Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->DELETE('http://localhost:3000/api/users/'.$id);

        if($user['message'] != 'success') {
            return redirect()->back()->withErrors($user['message']);
        }

        return redirect('admin/profile')->with('success', "Account Deleted!");
    }
}
