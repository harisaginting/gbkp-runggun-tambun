<?php namespace App\Helpers;

use App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Log;
use Auth;
use Cache;
use Carbon\Carbon;
use Session;
use Redirect;

class Harisa
{

    public static function getConfigByType($type,$q){
        $data = DB::table('m_general')->whereRaw("UPPER(type) = '".trim($type)."'");   
        
        if(!empty($q)){
            $data->whereRAW("UPPER(value) like '%".strtoupper($q)."%'");
        }
        return $data->orderBy('value','asc')->get()->toArray();
    }
    
    public static function get_marga($q=null){
        $marga = DB::table('m_general')->where('type','=','marga');
        if(!empty($q)){
            $marga->whereRAW("UPPER(value) like '%".strtoupper($q)."%'");
        }
        return $marga->orderBy('value','asc')->get()->toArray();
    }

    public static function get_sektor(){
        return DB::table('m_general')->where('type','=','sektor')->orderBy('value','asc')->get()->toArray();
    }

    public static function get_pekerjaan(){
        return DB::table('m_general')->where('type','=','pekerjaan')->orderBy('value','asc')->get()->toArray();
    }

    public static function get_pendidikan(){
        return DB::table('m_general')->where('type','=','pendidikan')->orderBy('value','asc')->get()->toArray();
    }

    public static function getUser($param){
        return Session::get($param);
    }

    public static function getConfigByName($name){
        $id = null;
        $data = DB::table('m_general')->whereRaw("UPPER(value) = '".trim($name)."'")->orderBy('value','asc')->first();   
        
        if(!empty($data->id)){
            $id = $data->id;
        }
        return intval($id);

    }

    public static function get_keluarga_status($q = null){
       $marga = DB::table('m_general')->where('type','=','status_keluarga');
        if(!empty($q)){
            $marga->whereRAW("UPPER(value) like '%".strtoupper($q)."%'");
        }
        return $marga->orderBy('value','asc')->get()->toArray();
    }

    public static function get_provinsi($q = null){
        $provinsi = DB::table('m_provinsi')->select("id_propinsi as id","nama_propinsi as nama");

        if(!empty($q)){
            $provinsi->whereRAW("UPPER(nama_propinsi) like '%".strtoupper($q)."%'");
        }

        return $provinsi->orderBy('nama_propinsi','asc')->get()->toArray();
    }

    public static function get_kabkota($q = null, $provinsi = null){
        $kab = DB::table('m_kabkota')->select("id_kabkota as id","nama_kabkota as nama");

        if(!empty($q)){
            $kab->whereRAW("UPPER(nama_kabkota) like '%".strtoupper($q)."%'");
        }

        if(!empty($provinsi)){
            $kab->where("id_propinsi",$provinsi);
        }

        return $kab->orderBy('nama_kabkota','asc')->get()->toArray();
    }

    public static function get_kecamatan($q = null, $kabupatan = null){
        $kecamatan = DB::table('m_kecamatan')->select("id_kecamatan as id","nama_kecamatan as nama");

        if(!empty($q)){
            $kecamatan->whereRAW("UPPER(nama_kecamatan) like '%".strtoupper($q)."%'");
        }

        if(!empty($kabupatan)){
            $kecamatan->where("id_kabkota",$kabupatan);
        }

        return $kecamatan->orderBy('nama_kecamatan','asc')->get()->toArray();
    }

    public static function apiResponse($status,$data,$message){
        return response()->json(['status'=>$status, 'data' => $data , 'message' => $message], $status);
    }
}