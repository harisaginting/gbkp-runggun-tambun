<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Artikel extends Model
{
    protected $guarded = [];
    protected $table = 'artikel';

     function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$sektor = null){
        $query      = DB::table('artikel as a')
                      ->select('a.*');
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(a.url_key) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.title) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.short_description) like '%".$searchValue."%'");
              });

        } 
        // if(!empty($sektor)){
        //     $query = $query->where("anggota.sektor",$sektor);
        // } 

        $fieldTable = array('a.url_key','a.title','a.category','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[1],$orderDir);
        }else{
            $query->orderBy('a.url_key','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
}
