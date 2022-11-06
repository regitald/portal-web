<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class MaintenanceController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        $data['data'] = $this->GET('http://localhost:3000/api/maintenance');
        $data['list_machine'] = $this->GET('http://localhost:3000/api/machine/kpi')['content'];
        $data['title'] = 'Maintenance';
        return view('admin.maintenance.view',$data);
    }

    public function store(Request $request){
        $store = $this->POST('http://localhost:3000/api/maintenance', $request->all());

        if($store['message'] != 'success') return redirect()->back()->withErrors($store);

        return redirect('/admin/maintenance')->with('success', "Success Input Data!");
    }

    public function update(Request $request) {
        $this->PUT('http://localhost:3000/api/maintenance/'.$request['id'], $request->all());

        return redirect('/admin/maintenance')->with('success', "Success Update Data!");
    }
}
