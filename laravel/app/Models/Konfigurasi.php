<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Konfigurasi extends Model
{
    protected $guarded = [];
    protected $table = 'm_general';

    public function getConfig($type , $name = null){
        if(empty($name)){
            return DB::table('m_general')->where('type',$type)->orderBy('value','asc')->get();    
        }else{
            $data = DB::table('m_general')->select('value')->where('type',$type)->orderBy('value','asc')->get();
            
            $result = array();
            foreach ($data as $key => $value) {
                array_push($result, $value->value);
            }
            return $result;

        }
        
    }

    function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status){
        $query      = DB::table($this->table);
                      // ->where('isAdmin',0);
        $countAll   = $query->count();

        if(!empty($searchValue)){
            $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("UPPER(a.type) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(a.value) like '%".$searchValue."%'");
              });

        } 


        $fieldTable = array('id','type','value');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[0],$orderDir);
        }else{
            $query->orderBy([['type','asc'],['value','asc']]);
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }
}
 