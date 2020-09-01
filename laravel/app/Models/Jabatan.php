<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Jabatan extends Model
{
    protected $guarded = [];
    protected $table = 'jabatan';


    function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order){
        $query      = DB::table('jabatan as a')
                      ->select('a.*');
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(a.name) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.description) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.title) like '%".$searchValue."%'");
              });

        } 

        $fieldTable = array('a.name','a.title','a.description','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[0],$orderDir);
        }else{
            $query->orderBy('a.name','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }

     function selectJabatan($q , $keluarga = null, $jabatan = null){
       $output         = DB::table("jabatan as a");

        if(!empty($q)){
            $q = strtoupper($q);
            $output->where(function($query) use ($q) {
                  $query->whereRaw("UPPER(a.name) like '%".$q."%'")
                    ->orWhereRaw("UPPER(a.description) like '%".$q."%'");
              }); 
        }
        return $output->get();
    }
    
}
 