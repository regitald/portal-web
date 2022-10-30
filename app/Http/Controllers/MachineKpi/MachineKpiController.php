<?php

namespace App\Http\Controllers\MachineKpi;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Session;

class MachineKpiController extends Controller
{
    use GeneralServices;

    public function index(){
        $response = $this->GET('http://localhost:3000/api/planning/daily');
        $data['data'] = $response['content'];
        $data['title'] = 'KPI Machine';
        return view('admin.production_analytic.kpi',$data);
    }

    public function all(){
        $response = $this->GET('http://localhost:3000/api/planning/daily');
        $data['data'] = $response['content'];
        $data['title'] = 'KPI All Machine';
        return view('admin.production_analytic.all',$data);
    }

}


