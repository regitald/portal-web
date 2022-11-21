<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardGraphicController extends Controller
{
    use GeneralServices;
    public function index()
        {
        $data['title'] = 'Yearly Graphic';
        $data['nama'] = '';
        $data['yearly_query'] =  DB::table('log_production')
                            ->select(DB::raw('sum(ok) as total, sum(ng) as ng, YEAR(`datetime`) as xa'))
                            
                            ->groupBy('xa')
                            ->orderBy('xa','ASC')
                            ->get();
       
        return view('admin.production.graphic.yearly',$data);
    }
    public function yearly($year)
        {
        $data['title'] = 'Yearly Graphic';
        $data['nama'] = '';
        $data['year'] = $year;
        $data['yearly_query'] =  DB::table('log_production')
                            ->select(DB::raw('sum(ok) as total, sum(ng) as ng, MONTH(`datetime`) as xa'))
                            ->whereYear('datetime','=',$year)
                            ->groupBy('xa')
                            ->orderBy('xa','ASC')
                            ->get();

        return view('admin.production.graphic.monthly',$data);
    }
    public function monthly($year,$month)
        {
        $data['title'] = 'Yearly Graphic';
        $data['nama'] = '';
        $data['year'] = $year;
        $data['yearly_query'] =  DB::table('log_production')
                            ->select(DB::raw('sum(ok) as total, sum(ng) as ng, DAY(`datetime`) as xa'))
                            ->whereYear('datetime','=',$year)
                            ->whereMonth('datetime','=',$month)
                            ->groupBy('xa')
                            ->orderBy('xa','ASC')
                            ->get();
        $data['machine_query'] =  DB::table('log_production')
                            ->select(DB::raw('sum(ok) as total, sum(ng) as ng, line_name as xa'))
                            ->whereYear('datetime','=',$year)
                            ->whereMonth('datetime','=',$month)
                            ->groupBy('xa')
                            ->orderBy('xa','ASC')
                            ->get();

        return view('admin.production.graphic.daily',$data);
    }
}