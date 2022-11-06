<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListMachineModel extends Model
{
    public function allData()
    {
         return DB::table('line_numbers')->get();
    }
    public function semua()
    {
         return DB::table('line_numbers')->get();
    }

    public function detailData($id)
    {
         return DB::table('line_numbers')->where('id', $id)->first();
    }
}