<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Session;

class DashboardController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        $data['title'] = 'Dashboard';
        return view('admin.dashboard.main',$data);
    }

    public function menu(Request $request, $id){

        Session::put('menu_id',$id);

        if($id == '1' || $id == 1) return redirect('/admin/planning-dashboard');
        if($id == '2' || $id == 2) return redirect('/admin/production-analytic');
        if($id == '3' || $id == 3) return redirect('/admin/maintenance');
    }

    public function planning(Request $request){
        $data['machine'] = $this->GET('http://localhost:3000/api/planning/daily/graphic?production_date_from='.date('Y-m-01').'&production_date_to='.date('Y-m-t'));
        $response = $this->GET('http://localhost:3000/api/planning/daily');
        $data['data'] = $response['content'];
        $data['title'] = 'Dashboard Planning';
        return view('admin.dashboard.planning',$data);
    }
}
