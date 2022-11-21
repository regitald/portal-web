<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use function GuzzleHttp\json_decode;

class ProductionAnalyticController extends Controller
{
    use GeneralServices;

    public function index(Request $request){
        // $data['list_ng'] = DB::select('select name from list_ng');
        // $data['list_machine'] = DB::select('select name, type from line_numbers');

        // $data['title'] = 'Rejection Pareto - Injection Area';
        // return view('admin.production.pareto.view',$data);
    }
}