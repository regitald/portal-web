<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;

class DashboardController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        $data['title'] = 'Dashboard';
        return view('admin.dashboard.main',$data);
    }

    public function planning(Request $request){
        $data['machine'] = $this->GET('http://localhost:3000/api/planning/daily/graphic?production_date_from='.date('Y-m-01').'&production_date_to='.date('Y-m-t'));
        $response = $this->GET('http://localhost:3000/api/planning/daily');
        $data['data'] = $response['content'];
        $data['title'] = 'Dashboard Planning';
        return view('admin.dashboard.planning',$data);
    }
}
