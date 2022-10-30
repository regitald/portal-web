<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Illuminate\Support\Facades\DB;

class KPIController extends Controller
{
    use GeneralServices;

    public function detail(Request $request){
        $data['title'] = 'KPI Detail';
        return view('admin.production.kpi.detail',$data);
    }
}
