<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NgGraphic extends Controller
{
    use GeneralServices;
    public function viewPostData()
{
    $data['title'] = 'POST DATA';
    $data['nama'] = '';
    $data['userhmi'] = DB::select('select username,name from user');
    $data['area'] = DB::select('select test from area_ng');
    $data['loopaja'] = DB::select('select id from loop_aja');
    $data['lm1'] = DB::select('select name, type from line_numbers');
    $data['ln1'] = DB::select('select name,id from list_ng');
    $data['lm'] = DB::select('select name, type from line_numbers');
    $data['ln'] = DB::select('select name from list_ng');
    $data['list_machine'] = DB::table('log_production')
                            ->select(DB::raw('sum(ng) as total,`desc`'))
                            ->where('ng', '=', '1' )
                            ->whereDate('datetime','>=','CURDATE()')
                            ->whereDate('datetime','<=','CURDATE()')
                            ->groupBy('desc')
                            ->get();
                            
    return view('admin.production.pareto.view',$data);
}

public function processPostData(Request $request)
{
    $data['title'] = 'POST DATA';
    $start = ''.$request->date_start.'';
    $stop = ''.$request->date_end.'';
    $value = ''.$request->list.'';
    $data['area'] = DB::select('select test from area_ng');
    $data['userhmi'] = DB::select('select username,name from user');
    $data['loopaja'] = DB::select('select id from loop_aja');
    $data['lm'] = DB::select('select name, type from line_numbers');
    $data['ln'] = DB::select('select name,id from list_ng');
    $data['lm1'] = DB::select('select name, type from line_numbers');
    $data['ln1'] = DB::select('select name,id from list_ng');
    $filtersng =  DB::table('list_ng')->pluck('name')->all();

    $axis = ''.$request->list_x.'';

    $user1 = ''.$request->u0347.'';
    $user2 = ''.$request->u0221.'';
    $user3 = ''.$request->u0372.'';
    $user4 = ''.$request->u1234.'';
    $user5 = ''.$request->u0585.'';
    $user6 = ''.$request->u0288.'';
    $user7 = ''.$request->u0527.'';
    $user8 = ''.$request->u0037.'';
    $user9 = ''.$request->u0693.'';
    $user10 = ''.$request->u0577.'';
    $user11 = ''.$request->u0614.'';
    $user12 = ''.$request->u0027.'';
    $user13 = ''.$request->u0704.'';
    $user14 = ''.$request->u0625.'';
    $user15 = ''.$request->u0659.'';
    $user16 = ''.$request->u0739.'';
    $user17 = ''.$request->u0777.'';
    $user18 = ''.$request->u0716.'';
    $user19 = ''.$request->u0726.'';
    $user20 = ''.$request->u0738.'';
    $user21 = ''.$request->u0036.'';
    $user22 = ''.$request->u0115.'';
    $user23 = ''.$request->u0151.'';
    $user24 = ''.$request->u0208.'';
    $user25 = ''.$request->u0762.'';
    $user26 = ''.$request->u0775.'';
    $user27 = ''.$request->u0615.'';
    $user28 = ''.$request->u0744.'';
    $user29 = ''.$request->u0396.'';
    $alluser = ''.$request->alluser.'';

    // dd(in_array('All',$request['line_numbers']));
    $data['list_machine'] = DB::table('log_production')
                            ->select(DB::raw('sum(ng) as total,`desc`,SUM(CASE WHEN area = "A1" THEN 1 ELSE 0 END) AS a1, SUM(CASE WHEN area = "A2" THEN 1 ELSE 0 END) AS a2,
			SUM(CASE WHEN area = "A3" THEN 1 ELSE 0 END) AS a3,
			SUM(CASE WHEN area = "A4" THEN 1 ELSE 0 END) AS a4,
			SUM(CASE WHEN area = "A5" THEN 1 ELSE 0 END) AS a5,
			SUM(CASE WHEN area = "B1" THEN 1 ELSE 0 END) AS b1,
			SUM(CASE WHEN area = "B2" THEN 1 ELSE 0 END) AS b2,
			SUM(CASE WHEN area = "B3" THEN 1 ELSE 0 END) AS b3,
			SUM(CASE WHEN area = "B4" THEN 1 ELSE 0 END) AS b4,
			SUM(CASE WHEN area = "B5" THEN 1 ELSE 0 END) AS b5,
			SUM(CASE WHEN area = "C1" THEN 1 ELSE 0 END) AS c1,
			SUM(CASE WHEN area = "C2" THEN 1 ELSE 0 END) AS c2,
			SUM(CASE WHEN area = "C3" THEN 1 ELSE 0 END) AS c3,
			SUM(CASE WHEN area = "C4" THEN 1 ELSE 0 END) AS c4,
			SUM(CASE WHEN area = "C5" THEN 1 ELSE 0 END) AS c5,
			SUM(CASE WHEN area = "D1" THEN 1 ELSE 0 END) AS d1,
			SUM(CASE WHEN area = "D2" THEN 1 ELSE 0 END) AS d2,
			SUM(CASE WHEN area = "D3" THEN 1 ELSE 0 END) AS d3,
			SUM(CASE WHEN area = "D4" THEN 1 ELSE 0 END) AS d4,
			SUM(CASE WHEN area = "D5" THEN 1 ELSE 0 END) AS d5,
			SUM(CASE WHEN area = "E1" THEN 1 ELSE 0 END) AS e1,
			SUM(CASE WHEN area = "E2" THEN 1 ELSE 0 END) AS e2,
			SUM(CASE WHEN area = "E3" THEN 1 ELSE 0 END) AS e3,
			SUM(CASE WHEN area = "E4" THEN 1 ELSE 0 END) AS e4,
			SUM(CASE WHEN area = "E5" THEN 1 ELSE 0 END) AS e5'))
                            ->where('ng', '=', '1')
                            ->whereDate('datetime','>=',$start)
                            ->whereDate('datetime','<=',$stop)
                            ->where(function ($query) use ($request, $filtersng) {
                                if($request['line_numbers']){
                                    if(!in_array('All',$request['line_numbers'])){
                                        $query->wherein('line_name', $request['line_numbers']);
                                    }
                                }
                                if($request['ng']){
                                    if (in_array('Others Only', $request['ng'])){
                                        $arrOthers = ['Weld Line','Jetting','Sink Mark','Kontaminasi','Black Dot','Crack','Scracth','Bubble','Short Mold','Oil','Flowmark','Flashing / Burry','Over Cutting','Silver','Flek','Others Only'];
                                        $query->whereNotIn('desc', $filtersng);
                                    }elseif(in_array('All', $request['ng'])){
                                        $query->wherein('desc', $request['ng'])->orWhere('desc', '!=', 'All');
                                    }else {
                                        $arrElse = ['Weld Line','Jetting','Sink Mark','Kontaminasi','Black Dot','Crack','Scracth','Bubble','Short Mold','Oil','Flowmark','Flashing / Burry','Over Cutting','Silver','Flek'];
                                        
                                        $query->wherein('desc', $request['ng'])->whereNotIn('desc', '!=', $arrElse);
                                    }
                                }
                                if($request['area']){ 
                                    if (!in_array('All',$request['area'])) {
                                            $query->whereIn('area', $request['area']);
                                    }
                                }
                                
                            })
                            ->where(function ($query2) use ($alluser,$user1,$user2,$user3,$user4,$user5,$user6,$user7,$user8,$user9,$user10,$user11,$user12,$user13,$user14,$user15,$user16,$user17,$user18,$user19,$user20,$user21,$user22,$user23,$user24,$user25,$user26,$user27,$user28,$user29) {
                               if ($alluser=="All") {
                                    $query2 -> where('op_id', '!=', 'all');
                               }else{
                                    $query2 -> where('op_id', '=', ''.$user1.'')
                                        ->orWhere('op_id', '=', ''.$user2.'')
                                        ->orWhere('op_id', '=', ''.$user3.'')
                                        ->orWhere('op_id', '=', ''.$user4.'')
                                        ->orWhere('op_id', '=', ''.$user5.'')
                                        ->orWhere('op_id', '=', ''.$user6.'')
                                        ->orWhere('op_id', '=', ''.$user7.'')
                                        ->orWhere('op_id', '=', ''.$user8.'')
                                        ->orWhere('op_id', '=', ''.$user9.'')
                                        ->orWhere('op_id', '=', ''.$user10.'')
                                        ->orWhere('op_id', '=', ''.$user11.'')
                                        ->orWhere('op_id', '=', ''.$user12.'')
                                        ->orWhere('op_id', '=', ''.$user13.'')
                                        ->orWhere('op_id', '=', ''.$user14.'')
                                        ->orWhere('op_id', '=', ''.$user15.'')
                                        ->orWhere('op_id', '=', ''.$user16.'')
                                        ->orWhere('op_id', '=', ''.$user17.'')
                                        ->orWhere('op_id', '=', ''.$user18.'')
                                        ->orWhere('op_id', '=', ''.$user19.'')
                                        ->orWhere('op_id', '=', ''.$user20.'')
                                        ->orWhere('op_id', '=', ''.$user21.'')
                                        ->orWhere('op_id', '=', ''.$user22.'')
                                        ->orWhere('op_id', '=', ''.$user23.'')
                                        ->orWhere('op_id', '=', ''.$user24.'')
                                        ->orWhere('op_id', '=', ''.$user25.'')
                                        ->orWhere('op_id', '=', ''.$user26.'')
                                        ->orWhere('op_id', '=', ''.$user27.'')
                                        ->orWhere('op_id', '=', ''.$user28.'')
                                        ->orWhere('op_id', '=', ''.$user29.'');
                               }
                                        })
                            
                            
                            ->orderBy('total','DESC' )
                            ->groupBy('desc')
                            ->get();

    return view('admin.production.pareto.view',$data);
}
}