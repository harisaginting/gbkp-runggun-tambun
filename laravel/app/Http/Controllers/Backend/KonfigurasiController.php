<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\AnggotaImport;
use App\Models\Konfigurasi;
use Carbon\Carbon;
use Harisa;
use Session;
use Excel;
use File;


class KonfigurasiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {   
        return view('backend.konfigurasi.index');
    }

     public function list(Request $request){
        $model  = new Konfigurasi();
        // echo json_encode($request->input());die;
        $length         = $request->input('length');
        $start          = $request->input('start');
        $searchValue    = !empty($_POST['search']['value']) ?  trim(strtoupper($_POST['search']['value'])) : null;
        $orderColumn    = $request->input('order')['0']['column'];
        $orderDir       = $request->input('order')['0']['dir'];
        $order          = $request->input('order');
        
        $status         = $request->input('status');

        $output         = $model->get_datatable($length, $start, $searchValue, $orderColumn, $orderDir, $order,$status);  
        $output['draw'] = $request->input('draw');

        echo json_encode($output); 
    }

    public function getConfig($type)
    {   
        $request    = new Request; 
        $q          = $request->input("q");
        echo json_encode(Harisa::getConfigByType($type, $q)) ;
    }

    public function getMarga(Request $r)
    {   
        $q = $r->input("q");
        echo json_encode(Harisa::get_marga($q)) ;
    }

    public function getProvinsi(Request $r)
    {   
        $q = $r->input("q");
        echo json_encode(Harisa::get_provinsi($q)) ;
    }

    public function getKabupaten(Request $r)
    {   
        $q          = $r->input("q");
        $provinsi   = $r->input('provinsi');
        echo json_encode(Harisa::get_kabkota($q, $provinsi)) ;
    }

    public function getKecamatan(Request $r)
    {   
        $q          = $r->input("q");
        $kabupaten  = $r->input('kabupaten');
        echo json_encode(Harisa::get_kecamatan($q, $kabupaten)) ;
    }

    public function getKeluargaStatus(Request $r)
    {   
        $q          = $r->input("q");
        echo json_encode(Harisa::get_keluarga_status($q)) ;
    }
}
