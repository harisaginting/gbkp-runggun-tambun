<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Anggota;
use App\Models\Keluarga;
use App\Models\Konfigurasi;
use Harisa;
use Session;

class DashboardController extends Controller
{
    
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
        $totalAnggota                   = array();
        $totalAnggota["all"]            = Anggota::where("visible",1)->count();
        $totalAnggota["kakr"]           = Anggota::where("visible",1)->where("kategorial","KA/KR")->count();
        $totalAnggota["permata"]        = Anggota::where("visible",1)->where("kategorial","PERMATA")->count();
        $totalAnggota["mamre"]          = Anggota::where("visible",1)->where("kategorial","MAMRE")->count();
        $totalAnggota["moria"]          = Anggota::where("visible",1)->where("kategorial","MORIA")->count();
        $totalAnggota["saitun"]         = Anggota::where("visible",1)->where("kategorial","SAITUN")->count();
        $totalKeluarga                  = Keluarga::count();
        return view('backend.dashboard.index',compact('totalAnggota','totalKeluarga')); 
    }


    function chartTotalKategorial(){     
        $chart                      = array();
        $sektor                     = Harisa::get_sektor();
        $data["list_sektor"]        = array();
        $data["list_kategorial"]    = Harisa::get_kategorial(true);
        foreach ($sektor as $key => $value) {
            array_push($data["list_sektor"], $value->value);
        }

        foreach ($data["list_kategorial"] as $key => $value) {
            $x["name"]  = $value;
            $x["data"]  = array();
            // $x["color"]  = "";
            foreach ($sektor as $key1 => $value1) {
                array_push($x["data"], Anggota::where("visible",1)->where("kategorial",$value)->where("sektor",$value1->id)->count());
            }
            array_push($chart, $x);
        }
        $data["chart"] = $chart;
        return Harisa::apiResponse(200, $data, 'success');
    }

}