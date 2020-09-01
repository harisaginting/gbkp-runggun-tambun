<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Anggota extends Model
{
    protected $guarded = [];
    protected $table = 'anggota';

    function getAnggota($id, $role = null, $password = null, $visible = null, $isDeleted = null){
    	
    $select = array(
                        'a.uuid',
                        'a.email',
                        'a.nama_depan',
                        'a.nama_belakang',
                        'a.nama_panggilan',
                        'a.jenis_kelamin',
                        'a.tanggal_lahir',
                        DB::raw("IFNULL(YEAR(CURDATE()) - YEAR(a.tanggal_lahir),0) as umur"),
                        'a.tempat_lahir',
                        'a.status_pernikahan',
                        'a.status',
                        'a.sektor',
                        'sektor.value as nama_sektor',
                        'a.pekerjaan',
                        'pekerjaan.value as nama_pekerjaan',
                        'a.perusahaan',
                        'a.pendidikan',
                        'pendidikan.value as nama_pendidikan',
                        'a.marga',
                        'marga.value as nama_marga',
                        'a.hobi',
                        'a.tahun_ngawan',
                        'a.runggun_ngawan',
                        'a.runggun',
                        'a.telepon',
                        'a.alamat',
                        'a.domisili_kecamatan',
                        'kecamatan.nama_kecamatan as kecamatan',
                        'a.domisili_kota',
                        'kabupaten.nama_kabkota as kota',
                        'a.domisili_provinsi',
                        'provinsi.nama_propinsi as provinsi',
                        'a.avatar',
                        'a.role'
                      );
      if(!empty($password)){
        array_push($select, 'password');
      }  

      $user =   DB::table('anggota as a')->select($select);
      $user->leftJoin('m_general as marga','a.marga','=','marga.id')
                      ->leftJoin('m_general as pendidikan','a.pendidikan','=','pendidikan.id')
                      ->leftJoin('m_general as pekerjaan','a.pekerjaan','=','pekerjaan.id')
                      ->leftJoin('m_general as sektor','a.sektor','=','sektor.id')
                      ->leftJoin('m_provinsi  as provinsi','a.domisili_provinsi','=','provinsi.id_propinsi')
                      ->leftJoin('m_kabkota   as kabupaten','a.domisili_kota','=','kabupaten.id_kabkota')
                      ->leftJoin('m_kecamatan as kecamatan','a.domisili_kecamatan','=','kecamatan.id_kecamatan'); 

      $user->where(function($u) use ($id) {
            $u->orWhere('a.uuid','=',$id);
            $u->orWhere('a.email','=',$id);
            $u->orWhere('a.username','=',$id);
      });

      if(!empty($role)){
        $user->where('a.uuid','=',$role);
      }            

      if(!empty($visible)){
        $user->where('a.visible','=',$visible);
      }  
      return $user->first();
    }

    function get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status = null,$kategorial = null,$sektor = null,$marga = null){
        $query      = DB::table('anggota as a')
                      ->select('a.*','sektor.value as nama_sektor','pekerjaan.value as nama_pekerjaan','marga.value as nama_marga','a.updated_at')
                      ->leftJoin('m_general as marga','a.marga','=','marga.id')
                      ->leftJoin('m_general as pendidikan','a.pendidikan','=','pendidikan.id')
                      ->leftJoin('m_general as pekerjaan','a.pekerjaan','=','pekerjaan.id')
                      ->leftJoin('m_general as sektor','a.sektor','=','sektor.id')
                      ->where('a.visible','=','1');
                      // ->where('isAdmin',0);
        $countAll   = $query->count();
        if(!empty($searchValue)){
            $query = $query->where(function($q) use ($searchValue) {
                  $q->whereRaw("CONCAT(UPPER(a.nama_depan),' ',UPPER(a.nama_belakang)) like '%".$searchValue."%'")
                    ->orWhereRaw("UPPER(marga.value) like '%".$searchValue."%'");
              });

        } 
        if(!empty($sektor)){
            $query = $query->where("a.sektor",$sektor);
        } 

        if(!empty($kategorial)){
            $query = $query->where("a.kategorial",$kategorial);
        } 

        if(!empty($status)){
            $query = $query->where("a.status",$status);
        } 

        if(!empty($marga)){
            $query = $query->where("a.marga",$marga);
        } 

        $fieldTable = array('a.nama_depan','a.nama_belakang','a.sektor','a.telepon','a.status','a.updated_at');
                
                // echo $orderColumn;die;
        if(!empty($fieldTable[$orderColumn])){
            $query->orderBy($fieldTable[4],$orderDir);
        }else{
            $query->orderBy('a.nama_depan','asc');
        }
        
        return array(
            "recordsTotal" => $countAll,
            "recordsFiltered" => $query->count(),
            "data" => $query->skip($start)->limit($length)->get(),
        );
    }


    function selectAnggota($q , $keluarga = null, $jabatan = null){
       $output         = DB::table("anggota as a")
                              ->select("a.*","keluarga_detail.id_keluarga")
                              ->where("visible","1")
                              ->leftJoin("keluarga_detail","keluarga_detail.id_anggota","=","a.uuid")
                              ->leftJoin("jabatan_anggota","jabatan_anggota.id_anggota","=","a.uuid");

        if(!empty($keluarga)){
          if($keluarga == "false"){
              $output = $output->whereNull("keluarga_detail.id_keluarga");
          }
        }

        if(!empty($jabatan)){
          if($jabatan== "false"){
              $output = $output->whereNull("keluarga_detail.id_keluarga");
          }
        }

        if(!empty($q)){
            $q = strtoupper($q);
            $output->where(function($query) use ($q) {
                  $query->whereRaw("UPPER(nama_depan) like '%".$q."%'")
                    ->orWhereRaw("UPPER(nama_belakang) like '%".$q."%'");
              }); 
        }
        return $output->get();
    }
}
 