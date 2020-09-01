<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JabatanAnggota extends Model
{
    protected $guarded = [];
    protected $table = 'jabatan_anggota';


    function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $select = array(
                        'a.*',
                        'anggota.nama_depan',
                        'anggota.nama_belakang',
                        'anggota.nama_panggilan',
                        'jabatan.name as jabatan_name',
                        'jabatan.title as jabatan_title',
                        DB::raw("DATE_FORMAT(a.period_start,'%d-%m-%Y') AS start_date "),
                        DB::raw("DATE_FORMAT(a.period_end,'%d-%m-%Y') AS end_date ")
                      );
        $query      = DB::table('jabatan_anggota as a')
                      ->select($select)
                      ->leftJoin('jabatan','jabatan.id','=','a.id_jabatan')
                      ->leftJoin('anggota','anggota.uuid','=','a.id_anggota');
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(anggota.nama_depan) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(anggota.nama_belakang) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(jabatan.name) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('jabatan.name','anggota.nama_panggilan','a.period_start','a.status','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[0],$orderDir);
        }else{
            $query->orderBy('jabatan.name','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
    
}
 