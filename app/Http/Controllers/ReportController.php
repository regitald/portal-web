<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use GeneralServices;
    public function index()
{
    $data['title'] = 'POST DATA';
    $data['nama'] = '';
    $data['userhmi'] = DB::select('select username,name from user');
    $data['lm'] = DB::select('select name, type from line_numbers');
     $data['list_machine'] = DB::table('log_production as a')
                                ->join('shift_times as b', function ($join) {
                                    $join->on(DB::raw('TIME(a.datetime)') ,'>=', 'b.start_production')
                                         ->on(DB::raw('TIME(a.datetime)') ,'<=', 'b.stop_production');
                                })
                            ->select(DB::raw("
                                    b.start_production as st,
                                    b.stop_production as ft,
                                    ROUND((AVG(UNIX_TIMESTAMP(CONCAT('1970-01-01',' ',b.stop_production))) - AVG(UNIX_TIMESTAMP(CONCAT('1970-01-01',' ',b.start_production))))/AVG(a.ct_plan)) as sampai,
                                    ROUND(SUM(CASE WHEN a.ok = 1 THEN 1 WHEN a.ok = -1 THEN -1 ELSE 0 END) - AVG(a.ct_plan))as target,
                                    IFNULL(SUM(CASE WHEN a.`desc` = 'Sink Mark' THEN 1 ELSE 0 END),0) AS ng1,
                                    SUM(CASE WHEN a.`desc` = 'Silver' and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr2,
                                    SUM(CASE WHEN a.`desc` = 'Silver' and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl2,
                                    SUM(CASE WHEN a.`desc` = 'DENTED' and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr3,
                                    SUM(CASE WHEN a.`desc` = 'DENTED' and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl3,
                                    SUM(CASE WHEN a.`desc` = 'Short Mold' THEN 1 ELSE 0 END) AS ng4,
                                    SUM(CASE WHEN a.`desc` = 'Jetting' THEN 1 ELSE 0 END) AS ng5,
                                    SUM(CASE WHEN a.`desc` = 'Kontaminasi' THEN 1 ELSE 0 END) AS ng6,
                                    SUM(CASE WHEN a.`desc` = 'Bubble' THEN 1 ELSE 0 END) AS ng79,
                                    SUM(CASE WHEN a.`desc` = 'NG SETTING' THEN 1 ELSE 0 END) AS ng8, 
                                    SUM(CASE WHEN a.`desc` = 'Weld line' THEN 1 ELSE 0 END) AS ng9, 
                                    SUM(CASE WHEN a.`desc` = 'Blackdot' THEN 1 ELSE 0 END) AS ng10,
                                    SUM(CASE WHEN a.`desc` = 'Setting' THEN 1 ELSE 0 END) AS ng11, 
                                    SUM(CASE WHEN a.`desc` = 'Flowmark' THEN 1 ELSE 0 END) AS ng12, 
                                    SUM(CASE WHEN a.`desc` = 'Oil' THEN 1 ELSE 0 END) AS ng13,
                                    SUM(CASE WHEN a.`desc` = 'Flek' THEN 1 ELSE 0 END) AS ng14, 
                                    SUM(CASE WHEN a.`desc` = 'Scratch' THEN 1 ELSE 0 END) AS ng15,
                                    SUM(CASE WHEN a.`desc` = 'Crack' THEN 1 ELSE 0 END) AS ng16,
                                    SUM(CASE WHEN a.ok = 1 THEN 1 WHEN a.ok = -1 THEN -1 ELSE 0 END) as total_ok,
                                    SUM(CASE WHEN a.ng = 1 THEN 1 ELSE 0 END) as total_ng,
                                    SUM(CASE WHEN a.`desc` = 'Mold (Polish)' THEN stopline ELSE 0 END) as coba,
                                    SUM(CASE WHEN a.`desc` = 'Shortage Man Power' THEN stopline ELSE 0 END) as coba1"))
                            ->where('a.line_name','=',"INJECTION/MC11")
                            ->groupBy('b.stop_production')
                            ->orderBy('b.stop_production','ASC')
                            ->get();
    return view('admin.report.daily_report',$data);
    
                            
    
}

public function postdata(Request $request)
{
    $data['title'] = 'POST DATA';
    $start = ''.$request->date_start.'';
    $line = ''.$request->line_name.'';
    
     $data['lm'] = DB::select('select name, type from line_numbers');
    $data['list_machine'] = DB::table('log_production as a')
                                ->join('shift_times as b', function ($join) {
                                    $join->on(DB::raw('TIME(a.datetime)') ,'>=', 'b.start_production')
                                         ->on(DB::raw('TIME(a.datetime)') ,'<=', 'b.stop_production');
                                })
                            ->select(DB::raw("
                                     FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(CONCAT('1970-01-01',' ',b.start_production))),'%H:%i:%s') as st,
                                    b.stop_production as ft,
                                    ROUND((AVG(UNIX_TIMESTAMP(CONCAT('1970-01-01',' ',b.stop_production))) - AVG(UNIX_TIMESTAMP(CONCAT('1970-01-01',' ',b.start_production))))/AVG(a.ct_plan)) as sampai,
                                    ROUND(SUM(CASE WHEN a.ok = 1 THEN 1 WHEN a.ok = -1 THEN -1 ELSE 0 END) - AVG(a.ct_plan))as target,
                                    SUM(CASE WHEN a.`desc` = 'Sink Mark'    and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr1,
                                    SUM(CASE WHEN a.`desc` = 'Sink Mark'    and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl1,
                                    SUM(CASE WHEN a.`desc` = 'Silver'       and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr2,
                                    SUM(CASE WHEN a.`desc` = 'Silver'       and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl2,
                                    SUM(CASE WHEN a.`desc` = 'DENTED'       and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr3,
                                    SUM(CASE WHEN a.`desc` = 'DENTED'       and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl3,
                                    SUM(CASE WHEN a.`desc` = 'Short Mold'   and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr4,
                                    SUM(CASE WHEN a.`desc` = 'Jetting'      and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr5,
                                    SUM(CASE WHEN a.`desc` = 'Kontaminasi'  and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr6,
                                    SUM(CASE WHEN a.`desc` = 'Bubble'       and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr7,
                                    SUM(CASE WHEN a.`desc` = 'NG SETTING'   and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr8, 
                                    SUM(CASE WHEN a.`desc` = 'Weld line'    and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr9, 
                                    SUM(CASE WHEN a.`desc` = 'Blackdot'     and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr10,
                                    SUM(CASE WHEN a.`desc` = 'Setting'      and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr11, 
                                    SUM(CASE WHEN a.`desc` = 'Flowmark'     and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr12, 
                                    SUM(CASE WHEN a.`desc` = 'Oil'          and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr13,
                                    SUM(CASE WHEN a.`desc` = 'Flek'         and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr14, 
                                    SUM(CASE WHEN a.`desc` = 'Scratch'      and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr15,
                                    SUM(CASE WHEN a.`desc` = 'Crack'        and a.position = 'RH' THEN 1 ELSE 0 END) AS ngr16,
                                    SUM(CASE WHEN a.`desc` = 'Short Mold'   and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl4,
                                    SUM(CASE WHEN a.`desc` = 'Jetting'      and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl5,
                                    SUM(CASE WHEN a.`desc` = 'Kontaminasi'  and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl6,
                                    SUM(CASE WHEN a.`desc` = 'Bubble'       and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl7,
                                    SUM(CASE WHEN a.`desc` = 'NG SETTING'   and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl8, 
                                    SUM(CASE WHEN a.`desc` = 'Weld line'    and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl9, 
                                    SUM(CASE WHEN a.`desc` = 'Blackdot'     and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl10,
                                    SUM(CASE WHEN a.`desc` = 'Setting'      and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl11, 
                                    SUM(CASE WHEN a.`desc` = 'Flowmark'     and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl12, 
                                    SUM(CASE WHEN a.`desc` = 'Oil'          and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl13,
                                    SUM(CASE WHEN a.`desc` = 'Flek'         and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl14, 
                                    SUM(CASE WHEN a.`desc` = 'Scratch'      and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl15,
                                    SUM(CASE WHEN a.`desc` = 'Crack'        and a.position = 'LH' THEN 1 ELSE 0 END) AS ngl16,
                                    SUM(CASE WHEN a.ok = 1 AND a.position = 'RH' THEN 1 WHEN a.ok = -1 AND a.position = 'RH' THEN -1 ELSE 0 END) as total_ok_rh,
                                    SUM(CASE WHEN a.ok = 1 AND a.position = 'LH' THEN 1 WHEN a.ok = -1 AND a.position = 'LH' THEN -1 ELSE 0 END) as total_ok_lh,
                                    SUM(CASE WHEN a.ng = 1 AND a.position = 'RH' THEN 1 ELSE 0 END) as total_ng_rh,
                                    SUM(CASE WHEN a.ng = 1 AND a.position = 'LH' THEN 1 ELSE 0 END) as total_ng_lh,
                                    SUM(CASE WHEN a.ok = 1 AND a.position = 'RH' THEN 1 WHEN a.ok = -1 AND a.position = 'RH' THEN -1 ELSE 0 END) + SUM(CASE WHEN a.ng = 1 AND a.position = 'RH' THEN 1 ELSE 0 END)  as total_rh,
                                    SUM(CASE WHEN a.ok = 1 AND a.position = 'LH' THEN 1 WHEN a.ok = -1 AND a.position = 'LH' THEN -1 ELSE 0 END) + SUM(CASE WHEN a.ng = 1 AND a.position = 'LH' THEN 1 ELSE 0 END)  as total_lh,
                                    SUM(CASE WHEN a.`desc` = 'Mold (Polish)' THEN stopline ELSE 0 END) as coba,
                                    SUM(CASE WHEN a.`desc` = 'Shortage Man Power' THEN stopline ELSE 0 END) as coba1"))
                            ->where('a.line_name','=',''.$line.'')
                            ->whereDate('a.datetime','=',''.$start.'')
                            ->groupBy('b.stop_production')
                            ->orderBy('b.stop_production','ASC')
                            ->get();
                            
    return view('admin.report.daily_report',$data);
    
}
}