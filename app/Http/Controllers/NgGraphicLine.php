<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NgGraphicLine extends Controller
{
    use GeneralServices;
    public function viewPostData()
{
    $data['title'] = 'POST DATA';
    $data['nama'] = '';
    $data['lm'] = DB::select('select name, type from line_numbers');
    $data['ln'] = DB::select('select name from list_ng');
    $data['list_machine'] = DB::table('log_production')
                            ->select(DB::raw('sum(ng) as total,`desc`'))
                            ->where('ng', '=', '1' )
                            ->whereDate('datetime','>=','CURDATE()')
                            ->whereDate('datetime','<=','CURDATE()')
                            ->groupBy('desc')
                            ->get();
                            
    return view('admin.production.pareto.line',$data);
}

public function processPostData(Request $request)
{
    $data['title'] = 'POST DATA';
    $start = ''.$request->date_start.'';
    $stop = ''.$request->date_end.'';
    $value = ''.$request->list.'';
    $data['lm'] = DB::select('select name, type from line_numbers');
    $data['ln'] = DB::select('select name,id from list_ng');
    $mc01 = ''.$request->MC01.'';
    $mc02 = ''.$request->MC02.'';
    $mc03 = ''.$request->MC03.'';
    $mc04 = ''.$request->MC04.'';
    $mc05 = ''.$request->MC05.'';
    $mc06 = ''.$request->MC06.'';
    $mc08 = ''.$request->MC08.'';
    $mc11 = ''.$request->MC11.'';
    $mc12 = ''.$request->MC12.'';

    $ln1 = ''.$request->n1.'';
    $ln2 = ''.$request->n2.'';
    $ln3 = ''.$request->n3.'';
    $ln4 = ''.$request->n4.'';
    $ln5 = ''.$request->n5.'';
    $ln6 = ''.$request->n6.'';
    $ln7 = ''.$request->n7.'';
    $ln8 = ''.$request->n8.'';
    $ln9 = ''.$request->n9.'';
    $ln10 = ''.$request->n10.'';
    $ln11 = ''.$request->n11.'';
    $ln12 = ''.$request->n12.'';
    $ln13 = ''.$request->n13.'';
    $ln14 = ''.$request->n14.'';
    $ln15 = ''.$request->n15.'';
    $ln16 = ''.$request->n16.'';
    $data['lm1'] = DB::select('select name, type from line_numbers');
    $data['ln1'] = DB::select('select name,id from list_ng');
    $axis = ''.$request->list_x.'';

    $data['list_machine'] = DB::table('log_production')
                            ->select(DB::raw('sum(ng) as total, line_name'))
                            ->where('ng', '=', '1')
                            ->whereDate('datetime','>=',$start)
                            ->whereDate('datetime','<=',$stop)
                            ->where(function ($query) use ($mc01,$mc02,$mc03,$mc04,$mc05,$mc06,$mc08,$mc11,$mc12) {
                                $query  ->where('line_name', '=', ''.$mc01.'')
                                        ->orWhere('line_name', '=', ''.$mc02.'')
                                        ->orWhere('line_name', '=', ''.$mc03.'')
                                        ->orWhere('line_name', '=', ''.$mc04.'')
                                        ->orWhere('line_name', '=', ''.$mc05.'')
                                        ->orWhere('line_name', '=', ''.$mc06.'')
                                        ->orWhere('line_name', '=', ''.$mc08.'')
                                        ->orWhere('line_name', '=', ''.$mc11.'')
                                        ->orWhere('line_name', '=', ''.$mc12.'');
                                        })
                            ->where(function ($query1) use ($ln1,$ln2,$ln3,$ln4,$ln5,$ln6,$ln7,$ln8,$ln9,$ln10,$ln11,$ln12,$ln13,$ln14,$ln15,$ln16) {
                                if ($ln16=="Others Only"){
                                    $query1  ->where('desc', '!=', 'Weld Line')
                                            ->where('desc', '!=', 'Jetting')
                                            ->where('desc', '!=', 'Sink Mark')
                                            ->where('desc', '!=', 'Kontaminasi')
                                            ->where('desc', '!=', 'Black Dot')
                                            ->where('desc', '!=', 'Crack')
                                            ->where('desc', '!=', 'Scracth')
                                            ->where('desc', '!=', 'Bubble')
                                            ->where('desc', '!=', 'Short Mold')
                                            ->where('desc', '!=', 'Oil')
                                            ->where('desc', '!=', 'Flowmark')
                                            ->where('desc', '!=', 'Flashing / Burry')
                                            ->where('desc', '!=', 'Over Cutting')
                                            ->where('desc', '!=', 'Silver')
                                            ->where('desc', '!=', 'Flek')
                                            ->where('desc', '!=', ''.$ln16.'');
                                }elseif($ln16=="All"){
                                    $query1  ->where('desc', '=', ''.$ln1.'')
                                        ->orWhere('desc', '=', ''.$ln2.'')
                                        ->orWhere('desc', '=', ''.$ln3.'')
                                        ->orWhere('desc', '=', ''.$ln4.'')
                                        ->orWhere('desc', '=', ''.$ln5.'')
                                        ->orWhere('desc', '=', ''.$ln6.'')
                                        ->orWhere('desc', '=', ''.$ln7.'')
                                        ->orWhere('desc', '=', ''.$ln8.'')
                                        ->orWhere('desc', '=', ''.$ln9.'')
                                        ->orWhere('desc', '=', ''.$ln10.'')
                                        ->orWhere('desc', '=', ''.$ln11.'')
                                        ->orWhere('desc', '=', ''.$ln12.'')
                                        ->orWhere('desc', '=', ''.$ln13.'')
                                        ->orWhere('desc', '=', ''.$ln14.'')
                                        ->orWhere('desc', '=', ''.$ln15.'')
                                        ->orWhere('desc', '!=', ''.$ln16.'');
                                }else {
                                    $query1  ->where('desc', '=', ''.$ln1.'')
                                        ->orWhere('desc', '=', ''.$ln2.'')
                                        ->orWhere('desc', '=', ''.$ln3.'')
                                        ->orWhere('desc', '=', ''.$ln4.'')
                                        ->orWhere('desc', '=', ''.$ln5.'')
                                        ->orWhere('desc', '=', ''.$ln6.'')
                                        ->orWhere('desc', '=', ''.$ln7.'')
                                        ->orWhere('desc', '=', ''.$ln8.'')
                                        ->orWhere('desc', '=', ''.$ln9.'')
                                        ->orWhere('desc', '=', ''.$ln10.'')
                                        ->orWhere('desc', '=', ''.$ln11.'')
                                        ->orWhere('desc', '=', ''.$ln12.'')
                                        ->orWhere('desc', '=', ''.$ln13.'')
                                        ->orWhere('desc', '=', ''.$ln14.'')
                                        ->orWhere('desc', '=', ''.$ln15.'')
                                        ->orWhere('desc', '=', ''.$ln16.'')
                                        ->where('desc', '!=', 'Weld Line')
                                            ->where('desc', '!=', 'Jetting')
                                            ->where('desc', '!=', 'Sink Mark')
                                            ->where('desc', '!=', 'Kontaminasi')
                                            ->where('desc', '!=', 'Black Dot')
                                            ->where('desc', '!=', 'Crack')
                                            ->where('desc', '!=', 'Scracth')
                                            ->where('desc', '!=', 'Bubble')
                                            ->where('desc', '!=', 'Short Mold')
                                            ->where('desc', '!=', 'Oil')
                                            ->where('desc', '!=', 'Flowmark')
                                            ->where('desc', '!=', 'Flashing / Burry')
                                            ->where('desc', '!=', 'Over Cutting')
                                            ->where('desc', '!=', 'Silver')
                                            ->where('desc', '!=', 'Flek');
                                }
                                
                                        })
                            
                            
                            ->orderBy('total','DESC' )
                            ->groupBy('line_name')
                            ->get();

    return view('admin.production.pareto.line',$data);
}
}