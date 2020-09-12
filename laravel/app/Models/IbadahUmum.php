<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IbadahUmum extends Model
{
    protected $guarded = [];
    protected $table = 'ibadah_umum';
    
     function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $query      = DB::table('ibadah_umum as a')
                      ->select('a.*',DB::raw("DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal_ibadah "));
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(a.nama) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.khotbah) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.pengkotbah) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('a.tanggal','a.waktu_mulai','a.pengkotbah','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[0],$orderDir);
        }else{
            $query->orderBy('a.tanggal','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
}
 