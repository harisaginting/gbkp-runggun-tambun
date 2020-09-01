<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use Harisa;
use Session;
use Carbon\Carbon;


class JabatanController extends Controller
{

    protected $jabatan;
    protected $r;

    public function __construct
    (
        Jabatan $jabatan,
        Request $r
    )
    {
        $this->jabatan = $jabatan;
        $this->r       = $r;
    }

    public function index()
    {   
        return view('backend.jabatan.config');
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
        $model  = new Jabatan;
        $model->name                = !empty($data["name"]) ? $data["name"] : null;
        $model->title               = !empty($data["title"]) ? $data["title"] : null;
        $model->description         = !empty($data["description"]) ? $data["description"] : null;        
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
                 return Harisa::apiResponse(200, Jabatan::whereId($data["id"])->get(), 'success');
             }else{
                return Harisa::apiResponse(200, Jabatan::whereId($model->id)->get(), 'success');
             }
         }else{
            return Harisa::apiResponse(401, null, 'not valid request' );
         }

    }


    private function updateProcess($id,$model){
        $modelRaw   = json_encode($model);
        $data      = json_decode($modelRaw,true);
        return Jabatan::where('id',$id)->update($data);
    }


    public function list(Request $request){
        $length         = $request->input('length');
        $start          = $request->input('start');
        $searchValue    = !empty($_GET['search']['value']) ? trim(strtoupper($_GET['search']['value'])) : null;
        $orderColumn    = $request->input('order')['0']['column'];
        $orderDir       = $request->input('order')['0']['dir'];
        $order          = $request->input('order');

        $output         = $this->jabatan->get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order);  
        $output['draw'] = $request->input('draw');

        echo json_encode($output); 
    }

    public function select(){

        $q          = $this->r->input("q");
        echo json_encode($this->jabatan->selectJabatan($q)); 
    }
    
}
