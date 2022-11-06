<?php

namespace App\Http\Controllers\MachineKpi;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralServices;
use Illuminate\Http\Request;
use App\Models\ListMachineModel;
use Session;

class MachineKpiController extends Controller
{
    use GeneralServices;

    public function __construct()
    {
        $this->ListMachineModel = new ListMachineModel();
    }

    public function index(){
        $data['title'] = 'KPI Machine';
        $test = [ 
            'listmachine' => $this->ListMachineModel->alldata(),
        ];
        $tah = [ 
            'lm' => $this->ListMachineModel->semua(),
        ];
        
        return view('admin.production_analytic.kpi_mqtt',$data,$test,$tah);
    }
    public function detail($id)
    {
        $data['title'] = 'KPI Machine';
    
        $tah = [ 
            'lm' => $this->ListMachineModel->detailData($id),
        ];
        
        return view('admin.production_analytic.kpi_detail',$data,$tah);
    }
    

    
 
}