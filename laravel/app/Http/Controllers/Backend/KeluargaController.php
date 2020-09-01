<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\KeluargaDetail;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Harisa;
use Session;
use Excel;
use File;
use DB;


class KeluargaController extends Controller
{

    protected $keluarga;
    protected $keluargaDetail;
    protected $r;

    public function __construct
    (
        Keluarga        $keluarga,
        keluargaDetail  $keluargaDetail,
        Request $r
    )
    {
        $this->keluarga         = $keluarga;
        $this->keluargaDetail   = $keluargaDetail;
        $this->r                = $r;
    }

    public function index()
    {   
        return view('backend.anggota.keluarga.index');
    }

    public function view(){
        return view('backend.anggota.keluarga.view');
    }

    public function add(){
        return view('backend.anggota.keluarga.add');
    }

    public function edit(){
        return view('backend.anggota.keluarga.edit');
    }

    public function get($id){
        $data["keluarga"] = Keluarga::whereId($id)->first();

        $query = DB::table('keluarga_detail as a')
                  ->select('a.*','anggota.nama_depan','anggota.nama_belakang','m_general.value as status_label')
                  ->where("a.id_keluarga",$id)
                  ->leftJoin('anggota','anggota.uuid','=','a.id_anggota')
                  ->leftJoin('m_general','a.status_anggota','=','m_general.id')
                  ->get();

        $data["keluarga_detail"] = $query;
        return Harisa::apiResponse(200, $data, 'success');
    }

    public function save(){
        $postData   = $this->r->post(); 

        $id_keluarga = $this->r->post("id_keluarga");
        $keluarga    = $this->r->post("keluarga");
        $anggota     = $this->r->post("anggota");


        $modelKeluarga = new Keluarga;
        $modelKeluarga->nama               = $keluarga;

        $maxStatus          = 0;
        $kepalaKeluarga     = 0;
        foreach ($anggota as $key => $value) {
            if($value["status"] > $maxStatus){
                $maxStatus      = $value["status"];
                $kepalaKeluarga = $value["anggota"];
            }
        }

        $modelKeluarga->kepala_keluarga    = $kepalaKeluarga;
        $modelKeluarga->updated_at         = Carbon::now();
        $modelKeluarga->updated_by         = $this->r->user["uuid"];

         if($id_keluarga){
            KeluargaDetail::whereIdKeluarga($id_keluarga)->delete();

            $ModelKeluargaDetail = array();
            foreach ($anggota as $key => $value) {
                $d["id_keluarga"]   = $id_keluarga;
                $d["id_anggota"]    = $value["anggota"];
                $d["status_anggota"]= $value["status"];
                array_push($ModelKeluargaDetail, $d);
            }
            KeluargaDetail::insert($ModelKeluargaDetail);
            $response =  $this->updateProcess($id_keluarga,$modelKeluarga);
         }else{
            $modelKeluarga->created_at         = Carbon::now();
            $modelKeluarga->save();
            KeluargaDetail::whereIdKeluarga($modelKeluarga->id)->delete();

            $ModelKeluargaDetail = array();
            foreach ($anggota as $key => $value) {
                $d["id_keluarga"]   = $modelKeluarga->id;
                $d["id_anggota"]    = $value["anggota"];
                $d["status_anggota"]= $value["status"];
                $d["updated_at"]    = Carbon::now();
                $d["created_at"]    = Carbon::now();
                array_push($ModelKeluargaDetail, $d);
            }
            KeluargaDetail::insert($ModelKeluargaDetail);
            $response = true;
         }
         if ($response){
            $responseData["keluarga"]   =  Keluarga::whereId($modelKeluarga->id)->first();
            $responseData["anggota"]    =  KeluargaDetail::whereId($modelKeluarga->id)->get();
            return Harisa::apiResponse(200, $responseData, 'success');
         }else{
            return Harisa::apiResponse(401, null, 'not valid request' );
         }

    }

    private function updateProcess($id,$model){
        $modelRaw = json_encode($model);
        $data      = json_decode($modelRaw,true);
        return Keluarga::where('id',$id)->update($data);
    }

    public function list(Request $request){
        $length         = $request->input('length');
        $start          = $request->input('start');
        $searchValue    = !empty($_GET['search']['value']) ? trim(strtoupper($_GET['search']['value'])) : null;
        $orderColumn    = $request->input('order')['0']['column'];
        $orderDir       = $request->input('order')['0']['dir'];
        $order          = $request->input('order');
        
        $sektor         = $request->input('sektor');

        $output         = $this->keluarga->get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order, $sektor);  
        $output['draw'] = $request->input('draw');

        echo json_encode($output); 
    }
    
}
