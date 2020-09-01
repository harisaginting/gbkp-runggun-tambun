<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Keluarga extends Model
{
    protected $guarded = [];
    protected $table = 'keluarga';


    function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$sektor = null){
        $query      = DB::table('keluarga as a')
                      ->select('a.*','anggota.nama_depan','anggota.nama_belakang','anggota.sektor','anggota_total.total')
                      ->leftJoin('anggota','anggota.uuid','=','a.kepala_keluarga')
                       ->join(DB::raw('(select count(id_keluarga) as total, id_keluarga 
                       			from keluarga_detail group by id_keluarga )
				               	anggota_total'), 
				        function($join)
				        {
				           $join->on('anggota_total.id_keluarga', '=', 'a.id');
				        });
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(anggota.nama_depan) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(anggota.nama_belakang) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.nama) like '%".$searchValue."%'");
              });

        } 
        if(!empty($sektor)){
            $query = $query->where("anggota.sektor",$sektor);
        } 

        $fieldTable = array('a.nama','anggota.nama_depan','anggota.nama_belakang','anggota.sektor','anggota.telepon','anggota.status','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[4],$orderDir);
        }else{
            $query->orderBy('anggota.nama_depan','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
    
}
 