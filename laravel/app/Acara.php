<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Acara extends Model
{
    protected $guarded = [];

    function get_pa($id){
        $data = DB::table('acara as m')
        ->select('m.nama','m.selesai','m.mulai','m.deskripsi','p.*','m.id as id_agenda','m.skala as skala','p.persembahan')
        ->leftJoin('pa as p','p.id_acara','=','m.id')
        ->where('m.tipe','=','pendalaman_alkitab')
        ->where('m.id','=',$id);

        return $data->first();
    }

    function get_datatable_pa($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status){
        $query      = DB::table('acara as m')
                        ->select('m.nama','m.selesai','m.mulai','m.deskripsi','p.*','m.id as id_agenda',DB::raw("DATE_FORMAT(m.mulai,'%d %M %Y') as tanggal_mulai"),DB::raw('IFNULL(total_peserta,0) as total_peserta'))
                        ->where('m.tipe','=','pendalaman_alkitab')
                        ->where('m.deleted','=','0')
                        ->leftJoin('pa as p','p.id_acara','=','m.id')
                        ->leftJoin(DB::raw("(SELECT count(*) as total_peserta, id_acara as id_acara_peserta from aktivitas_anggota group by id_acara ) a"),'a.id_acara_peserta','=','m.id');
        $countAll   = $query->count();


        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(m.nama) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('m.nama',null);
                
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[$orderColumn],$orderDir);
        }else{
            $query->orderBy('m.mulai','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }

    function getPaPeople($id){
        $data['tuan_rumah'] = DB::table('aktivitas_anggota as main')
                                    ->select('main.*','anggotas.nama as nama_anggota')
                                    ->join('anggotas','main.id_anggota','=','anggotas.id')
                                    ->where('main.id_acara',$id)
                                    ->where('peran','tuan_rumah')
                                    ->get(); 

        $data['peserta'] = DB::table('aktivitas_anggota as main')
                                    ->select('main.*','anggotas.nama as nama_anggota')
                                    ->join('anggotas','main.id_anggota','=','anggotas.id')
                                    ->where('main.id_acara',$id)
                                    ->where('peran','peserta')
                                    ->get(); 
        return $data;
        }
}
 