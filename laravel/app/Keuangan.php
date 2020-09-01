<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Keuangan extends Model
{
    protected $guarded = [];
    protected $table = 'iuran_kas';

    function get_iuran_kas($year = null){
        if(empty($year)){
            $year = date('Y');
        }

        $data =   DB::table('m_parameter')
                    ->select('type','nama')
                    ->where(function($q){
                      $q->where('type','=','iuran_kas_pekerja')
                        ->orWhere('type','=','iuran_kas_pelajar');
                        })
                    ->where('tahun','=',$year)
                    ->get();

        $param = array();
        foreach ($data as $key => $value) {
            $param[$value->type]= intval($value->nama);
        }
        return $param;
    }

    function add_iuran_kas($data){
        return DB::table('iuran_kas')
                ->insert($data);
    }

    function delete_iuran_kas($id){
        return DB::table('iuran_kas')
            ->where('id','=',$id)
            ->delete();
    }

    function deletePengeluaran($id){
        return DB::table('pengeluaran')
            ->where('id','=',$id)
            ->update(
                array(
                    'deleted' => 1,
                    'deleted_by' => Session::get('id_anggota'),
                    'deleted_at' => date('Y-m-d')
                )
            );
    }

    function get_datatable_persembahan_pa($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $query      = DB::table('pa as a')
                        ->select('a.*','g.nama',DB::raw('DATE_FORMAT(g.mulai, "%Y-%m-%d") as tmulai'))
                        ->join('acara as g','a.id_acara','=','g.id');
        $countAll   = $query->count();



        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(nama) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(ayat) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('tmulai','nama','persembahan',null);
                
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[$orderColumn],$orderDir);
        }else{
            $query->orderBy('nama','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }

    function get_datatable_pemasukanKantin($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $query      = DB::table('kantin as m')
                        ->select('m.*');
        $countAll   = $query->count();



        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(tujuan) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(keterangan) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('tanggal','pemasukan','tujuan','keterangan');
                
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[$orderColumn],$orderDir);
        }else{
            $query->orderBy('tanggal','desc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }

    function get_datatable_iuran_kas($length, $start, $searchValue, $orderColumn, $orderDir, $order,$tahun,$sektor){
        $query      = DB::table('iuran_kas as a')
                        ->select('a.*','b.nama',DB::raw("case when b.pekerjaan in ('Pelajar','Mahasiswa') THEN 'Pelajar' ELSE 'Pekerja' END AS status_pekerja"),'b.sektor')
                        ->leftJoin('anggota as b','a.id_anggota','=','b.id');
                        // ->where('a.deleted','=',0);
        $countAll   = $query->count();


        if(!empty($tahun)){
            $query->where('tahun','=',$tahun);
        }

        if(!empty($sektor)){
            $query->where('sektor','=',$sektor);
        }


        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(nama) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(marga) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('nama','nominal','tanggal_pembayaran','keterangan',null);
                
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[$orderColumn],$orderDir);
        }else{
            $query->orderBy('nama','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start -1)->limit($length)->get(),
        );
    }

    function getDatatablePengeluaranKas($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $query      = DB::table('pengeluaran as m')->where('deleted','=',0);
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(nama) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(marga) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('nominal','tanggal','keterangan',null);
                
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[$orderColumn],$orderDir);
        }else{
            $query->orderBy('tanggal','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
}
 