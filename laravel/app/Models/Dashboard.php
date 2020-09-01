<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dashboard extends Model
{
    protected $guarded = [];

    function getAnggotaByStatus($sektor, $status){
        return DB::table('anggota')->where('status',$status)->where('sektor',$sektor)->get();
    }


    function getChartAnggota(){
        $data = DB::table('anggota')
                ->select(DB::raw("IFNULL(count(anggota.id),0) as y"),'param.nama as name')
                ->leftJoin("m_parameter as param",'param.id','=','anggota.sektor')
                ->groupBy('sektor')
                ->get();
        $result = array();
        foreach ($data as $key => $value) {
            $result[$key]['name'] = !empty($value->name) ? $value->name : 'undefined'; 
            $result[$key]['y'] = intval($value->y); 
        }
        return $result;
         // echo json_encode($result);die;
    }
}
 