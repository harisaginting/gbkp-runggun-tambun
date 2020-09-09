<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IbadahUmum;
use Harisa;
use Carbon\Carbon;


class IbadahUmumController extends Controller
{

    protected $ibadah;
    protected $r;

    public function __construct
    (
        IbadahUmum $ibadah,
        Request $r
    )
    {
        $this->ibadah = $ibadah;
        $this->r       = $r;
    }

    public function index()
    {   
        return view('backend.ibadah.umum.index');
    }

    public function add()
    {   
        return view('backend.ibadah.umum.add');
    }

    public function get($id){
        return Harisa::apiResponse(200, Jabatan::whereId($id)->first(), 'success');
    }

    public function save(){
        $postData   = $this->r->post(); 
        $data       = array();
        
        $songleaderArr   = array();
        foreach ($postData as $key => $value) {
             if ($value["name"] == "songleader[]" ) {
                array_push($songleaderArr, $value["value"]);
             }else{
                $data[$value["name"]] = $value["value"];
             }
        } 
        $songleader = json_encode($songleaderArr);

        $persembahencount = 1;
        $persembahen      = null;
        $persembahenArr   = array();
        foreach ($postData as $key => $value) {
             if ($value["name"] == "persembahen[]" ) {
                $persembahenArr["persembahen-".$persembahencount] = $value["value"];
                $persembahencount++;
             }else{
                $data[$value["name"]] = $value["value"];
             }
        } 
        $persembahen = json_encode($persembahenArr);

        $tanggalIbadah = null;
        if (!empty($data["tanggal"])){
            $rawDate        = explode("-", $data["tanggal"]);
            $tanggalIbadah  = $rawDate[2]."-".$rawDate[1]."-".$rawDate[0];
        }

        $model = new IbadahUmum;
        $model->nama        = $data["nama"];
        $model->tema        = $data["tema"];
        $model->khotbah     = !empty($data["khotbah"]) ? $data["khotbah"] : null;
        $model->invocatio   = !empty($data["invocatio"]) ? $data["invocatio"] : null;
        $model->ogen        = !empty($data["ogen"]) ? $data["ogen"] : null;
        $model->tanggal     = !empty($tanggalIbadah) ? $tanggalIbadah : null;
        $model->waktu_mulai = !empty($data["waktu_mulai"]) ? $data["waktu_mulai"] : null;
        $model->waktu_selesai = !empty($data["waktu_selesai"]) ? $data["waktu_selesai"] : null;
        $model->pengkotbah  = !empty($data["pengkotbah"]) ? $data["pengkotbah"] : null;
        $model->liturgi     = !empty($data["liturgi"]) ? $data["liturgi"] : null;
        $model->koordinator = !empty($data["koordinator"]) ? $data["koordinator"] : null;
        $model->simabaenden = !empty($data["simabaenden"]) ? $data["simabaenden"] : null;
        $model->sinaruh     = !empty($data["sinaruh"]) ? $data["sinaruh"] : null;
        $model->siermomo    = !empty($data["siermomo"]) ? $data["siermomo"] : null;
        $model->songleader  = !empty($songleader) ? $songleader : null;
        $model->persembahen = !empty($persembahen) ? $persembahen : null;
        $model->organis     = !empty($data["organis"]) ? $data["organis"] : null;
        $model->link_page   = !empty($data["link_page"]) ? $data["link_page"] : null;
        $model->link_youtube = !empty($data["link_youtube"]) ? $data["link_youtube"] : null;
        $model->sipulung    = !empty($data["sipulung"]) ? $data["sipulung"] : null;
        $model->jumlah_persembahen = !empty($data["jumlah_persembahen"]) ? $data["jumlah_persembahen"] : null;
        $model->updated_by  = $this->r->user["uuid"];
        $model->updated_at          = Carbon::now();

         if(!empty($data["id_ibadah"])){
            $model->created_at          = Carbon::now();
            $response                   =  $this->updateProcess($data["id_ibadah"],$model);
         }else{
            $model->save();
            $response = true;
         }
         if ($response){
            if(!empty($data["id_ibadah"])){
                 return Harisa::apiResponse(200, IbadahUmum::whereIdIbadah($data["id_ibadah"])->get(), 'success');
             }else{
                return Harisa::apiResponse(200, IbadahUmum::whereIdIbadah($model->id_ibadah)->get(), 'success');
             }
         }else{
            return Harisa::apiResponse(401, null, 'not valid request' );
         }

    }


    private function updateProcess($id,$model){
        $modelRaw   = json_encode($model);
        $data       = json_decode($modelRaw,true);
        return IbadahUmum::where('id_ibadah',$id)->update($data);
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
