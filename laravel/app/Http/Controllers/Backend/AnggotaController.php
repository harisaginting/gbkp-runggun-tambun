<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Illuminate\Support\Facades\Mail;
use Harisa;
use Session;
use Excel;
use File;


class AnggotaController extends Controller
{

    protected $user;
    protected $anggota;
    protected $r;

    public function __construct
    (
        Anggota $anggota,
        Request $r
    )
    {
        $this->anggota = $anggota;
        $this->r       = $r;
    }

    public function index()
    {   
        return view('backend.anggota.index');
    }

    public function view(){
        return view('backend.anggota.view');
    }

    public function add(){
        return view('backend.anggota.add');
    }

    public function edit(){
        return view('backend.anggota.edit');
    }

    public function get($uuid){
        return Harisa::apiResponse(200, $this->anggota->getAnggota($uuid), 'success');
    }

    public function save(){
        $postData   = $this->r->post(); 
        $data       = array();
        foreach ($postData as $key => $value) {
             $data[$value["name"]] = $value["value"];
         } 

        $email      = strtolower($data['email']);
        $username   = null;
        if(empty($email)){
            $username = strtolower($data["nama_depan"]).strtolower($data["nama_belakang"]);
        }else{
            $userCek        = $this->anggota->getAnggota($email);
            if(!empty($userCek) && empty($data["id_anggota"])){
                return Harisa::apiResponse(501, null, 'user with same email already exist' );
            }
            $emailArr = explode("@", $email);
            $username = $emailArr[0];
        }

        $tanggal_lahir = null;
        $rawBirthday = array();
        if (!empty($data["tanggal_lahir"])){
            $rawBirthday    = explode("-", $data["tanggal_lahir"]);
            $tanggal_lahir  = $rawBirthday[2]."-".$rawBirthday[1]."-".$rawBirthday[0];
        }

        $kategorial         =  "KA/KR";
        $status_pernikahan  =  $data["status_pernikahan"];
        if (!empty($data["tahun_ngawan"]) || !empty($data["lokasi_ngawan"])){
            $kategorial = "PERMATA";
        }

        if($status_pernikahan == 1 || $status_pernikahan == "1"){
           if($data["jenis_kelamin"] == "L"){
            $kategorial = "MAMRE";
           }else{
            $kategorial = "MORIA";
           }
        }

        if(!empty($rawBirthday[0])){
            if(date('Y') - intval($rawBirthday[2]) > 65){
                $kategorial = "SAITUN";
            }
        }

        $telepon = ltrim($data['telepon'], '0');
        $telepon = ltrim($data['telepon'], '+62');

        $confirmationCode           = str_replace('-', '',Uuid::uuid4()).$data["email"];
        $member = new Anggota;
        $member->email              = $email;
        $member->username           = $username;
        $member->nama_depan         = ucwords($data["nama_depan"]);
        $member->nama_belakang      = ucwords($data["nama_belakang"]);
        $member->tanggal_lahir      = $tanggal_lahir;
        $member->tempat_lahir       = $data['tempat_lahir'];
        $member->jenis_kelamin      = $data['jenis_kelamin'];
        $member->marga              = $data['marga'];

        $member->status_pernikahan  = $data['status_pernikahan'];
        $member->kategorial         = $kategorial;
        
        $member->pekerjaan          = $data['pekerjaan'];
        $member->pendidikan         = $data['pendidikan'];

        $member->telepon            = $telepon;
        $member->domisili_provinsi  = $data['domisili_provinsi'];
        $member->domisili_kota      = $data['domisili_kota'];
        $member->domisili_kecamatan = $data['domisili_kecamatan'];
        $member->alamat             = $data['alamat'];
        $member->hobi               = $data['hobi'];
       
        $member->runggun            = "TAMBUN";
        $member->sektor             = $data['sektor'];
        $member->tahun_ngawan       = $data['tahun_ngawan'];
        $member->runggun_ngawan     = strtolower($data['runggun_ngawan']);

        $member->confirmation       = $confirmationCode;
        $member->updated_at         = Carbon::now();
        $member->updated_by         = $this->r->user["uuid"];

        if (!empty($data["nama_panggilan"])) {
            $member->nama_panggilan = ucwords($data["nama_panggilan"]);
        }else{
            $member->nama_panggilan = $member->nama_depan." ".$member->nama_belakang;
        }

         if(!empty($data["id_anggota"])){
            $response =  $this->updateProcess($data["id_anggota"],$member);
         }else{
            $member->uuid = Uuid::uuid4();
            $member->created_at         = Carbon::now();
            $member->save();
            $response = true;
         }
         if ($response){
            if(!empty($data["id_anggota"])){
                return Harisa::apiResponse(200, $this->anggota->getAnggota($data["id_anggota"]), 'success');
             }else{
                return Harisa::apiResponse(200, $this->anggota->getAnggota($member->uuid), 'success');
             }
         }else{
            return Harisa::apiResponse(401, null, 'not valid request' );
         }

    }

    private function updateProcess($id,$member){
        $memberRaw = json_encode($member);
        $data      = json_decode($memberRaw,true);
        return Anggota::where('uuid',$id)->update($data);
    }

    public function list(Request $request){
        $length         = $request->input('length');
        $start          = $request->input('start');
        $searchValue    = !empty($_GET['search']['value']) ? trim(strtoupper($_GET['search']['value'])) : null;
        $orderColumn    = $request->input('order')['0']['column'];
        $orderDir       = $request->input('order')['0']['dir'];
        $order          = $request->input('order');
        
        $status         = $request->input('status');
        $kategorial     = $request->input('kategorial');
        $sektor         = $request->input('sektor');
        $marga          = $request->input('marga');

        $output         = $this->anggota->get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status,$kategorial,$sektor,$marga);  
        $output['draw'] = $request->input('draw');

        echo json_encode($output); 
    }

    public function select(){

        $q          = $this->r->input("q");
        $keluarga   = $this->r->input("keluarga");
        $jabatan    = $this->r->input("jabatan");
        echo json_encode($this->anggota->selectAnggota($q, $keluarga,$jabatan)); 
    }
    
}
