<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\JabatanAnggota;
use Harisa;
use Session;
use Carbon\Carbon;


class JabatanAnggotaController extends Controller
{

    protected $jabatan;
    protected $jabatanAnggota;
    protected $r;

    public function __construct
    (
        Jabatan $jabatan,
        JabatanAnggota $jabatanAnggota,
        Request $r
    )
    {
        $this->jabatanAnggota = $jabatanAnggota;
        $this->jabatan = $jabatan;
        $this->r       = $r;
    }

    public function index()
    {   
        return view('backend.jabatan.index');
    }

    public function get($id){
        return Harisa::apiResponse(200, Jabatan::whereId($id)->first(), 'success');
    }

    public function save(){
        $postData   = $this->r->post(); 
        $data       = array();
        foreach ($postData as $key => $value) {
             $data[$value["name"]] = $value["value"];
        } 
        $model  = new JabatanAnggota;
        $model->id_anggota          = !empty($data["anggota"]) ? $data["anggota"] : null;
        $model->id_jabatan          = !empty($data["jabatan"]) ? $data["jabatan"] : null;
        

        $periodStart = $periodEnd = null;

        if (!empty($data["period_start"])) {
            $rawDate        = explode("-", $data["period_start"]);
            $periodStart    = $rawDate[2]."-".$rawDate[1]."-".$rawDate[0];
        }
        if (!empty($data["period_end"])) {
            $rawDateEnd     = explode("-", $data["period_end"]);
            $periodEnd      = $rawDateEnd[2]."-".$rawDateEnd[1]."-".$rawDateEnd[0];
        }

        if (!empty($periodStart)) {
            $model->period_start        = $periodStart;     
        }

        if (!empty($periodEnd)) {
            $model->period_end          = $periodEnd; 
        }

        $model->updated_at          = Carbon::now();
        $model->updated_by          = $this->r->user["uuid"];      

         if(!empty($data["id"])){
            $model->created_at          = Carbon::now();
            $response =  $this->updateProcess($data["id"],$model);
         }else{
            $model->save();
            $response = true;
         }
         if ($response){
            if(!empty($data["id"])){
                 return Harisa::apiResponse(200, JabatanAnggota::whereId($data["id"])->get(), 'success');
             }else{
                return Harisa::apiResponse(200, JabatanAnggota::whereId($model->id)->get(), 'success');
             }
         }else{
            return Harisa::apiResponse(401, null, 'not valid request' );
         }

    }


    private function updateProcess($id,$model){
        $modelRaw   = json_encode($model);
        $data      = json_decode($modelRaw,true);
        return JabatanAnggota::where('id',$id)->update($data);
    }


    public function list(Request $request){
        $length         = $request->input('length');
        $start          = $request->input('start');
        $searchValue    = !empty($_POST['search']['value']) ? trim(strtoupper($_POST['search']['value'])) : null;
        $orderColumn    = $request->input('order')['0']['column'];
        $orderDir       = $request->input('order')['0']['dir'];
        $order          = $request->input('order');

        $output         = $this->jabatanAnggota->get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order);  
        $output['draw'] = $request->input('draw');

        echo json_encode($output); 
    }
    
}
