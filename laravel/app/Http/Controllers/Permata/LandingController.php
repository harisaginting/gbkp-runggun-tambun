<?php

namespace App\Http\Controllers\Permata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Konfigurasi;
use App\Models\Member;
use App\Models\Dashboard;
use App\Models\Anggota;
use Session;
use Harisa;
use DB;

class LandingController extends Controller
{

    public function index()
    {
        return view('permata.home');
    }

    public function login()
    {
        if(!empty(Session::get('isLogin')) && Session::get('isLogin') == 1 ){
             return redirect(url('/').'/member');
        }      
        $title       = "LOGIN | PERMATA GBKP";
        $description = "Keanggotaan Permata GBKP Runggun Tambun";
        return view('frontend.login',compact('title','description'));
    }

    public function register()
    {
        $marga      = Harisa::get_marga();
        $sektor     = Harisa::get_sektor();
        $title       = "PENDAFTARAN | PERMATA GBKP";
        $description = "Pendaftaran Anggota Permata GBKP Runggun Tambun";
        return view('frontend.register',compact('marga','sektor','title','description'));
    }

    public function forgotPassword(){
        return view('frontend.forgot_password');
    }

    public function information(){
        $config                        = new Konfigurasi();   
        $chartAnggota                  = $this->chartAnggota();
        $totalAnggota                  = array();
        $totalAnggota["all"]           = Anggota::whereRaw("sektor is not null")->where('kategorial','=','PERMATA')->count();
        $totalAnggota["aktif"]         = Anggota::whereRaw("sektor is not null")->where('kategorial','=','PERMATA')->where("status","AKTIF")->count();
        $totalAnggota["pasif"]         = Anggota::where("status","PASIF")->where('kategorial','=','PERMATA')->whereRaw("sektor is not null")->count();
        $totalAnggota["terdaftar"]     = Anggota::where("status","TERDAFTAR")->where('kategorial','=','PERMATA')->whereRaw("sektor is not null")->count();
        $sektor                        = $config->getConfig('sektor',true);
        $sektor2                       = $config->getConfig('sektor');
        $anggotaBySektor               = array();

        $totalDalamBekasi              = Anggota::where("domisili_kota",16)->where('kategorial','=','PERMATA')->whereRaw("sektor is not null")->count();
        $totalLuarBekasi               = Anggota::whereRaw("domisili_kota != 16")->where('kategorial','=','PERMATA')->whereRaw("sektor is not null")->count();

        foreach ($sektor2 as $key => $value) {
            $anggotaBySektor[$value->value] = DB::table('anggota as a')->select(
                        'a.uuid',
                        'a.email',
                        'a.nama_depan',
                        'a.nama_belakang',
                        'a.nama_panggilan',
                        'a.jenis_kelamin',
                        'a.tanggal_lahir',
                        DB::raw("IFNULL(YEAR(CURDATE()) - YEAR(a.tanggal_lahir),0) as umur"),
                        'a.tempat_lahir',
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
                        'a.instagram',
                        'a.alamat',
                        'a.domisili_kecamatan',
                        'kecamatan.nama_kecamatan as kecamatan',
                        'a.domisili_kota',
                        'kabupaten.nama_kabkota as kota',
                        'a.domisili_provinsi',
                        'provinsi.nama_propinsi as provinsi',
                        'a.avatar'
                      )
                      ->leftJoin('m_general as marga','a.marga','=','marga.id')
                      ->leftJoin('m_general as pendidikan','a.pendidikan','=','pendidikan.id')
                      ->leftJoin('m_general as pekerjaan','a.pekerjaan','=','pekerjaan.id')
                      ->leftJoin('m_general as sektor','a.sektor','=','sektor.id')
                      ->leftJoin('m_provinsi as provinsi','a.domisili_provinsi','=','provinsi.id_propinsi')
                      ->leftJoin('m_kabkota as kabupaten','a.domisili_kota','=','kabupaten.id_kabkota')
                      ->leftJoin('m_kecamatan as kecamatan','a.domisili_kecamatan','=','kecamatan.id_kecamatan')
                      ->where('a.sektor','=',$value->id)
                      ->where('a.kategorial','=','PERMATA')
                      ->orderBy("a.nama_depan","asc")->get();
        }

        // echo json_encode($anggotBySektor);die;
        $title       = "INFORMASI | PERMATA GBKP";
        $description = "Informasi Keanggota Permata GBKP Runggun Tambun";
        return view('permata.information',compact('sektor','chartAnggota','totalAnggota','anggotaBySektor','description','totalDalamBekasi','totalLuarBekasi'));
    }

    function chartAnggota(){
        $chartAnggota       =   array();
        $color1             =   array('#1d23aa ', '#0d23da', '#2f7ed8', '#3d6ae8', '#4e5fe8','#4f9fe8', '#5a9fff', '#77a1e5', '#c42525', '#a6c96a');
        $model              = new Dashboard();
        $config             = new Konfigurasi();        
        $chart              =   array();
        $status             =   array('aktif','pasif','terdaftar');
        
        $color2             =   array('#04c100','#f9c237','#d94c42');
        $sektor             =   $config->getConfig('sektor');
        $pekerjaan          =   $config->getConfig('pekerjaan');
        $chart = array();
        foreach ($sektor as $key => $value) {
            $drilldown['name'] = $value->value;
            $drilldown['categories']    = array();
            $drilldown['data']          = array();
            $drilldown['color']         = array();
            $total = 0;
            foreach ($status as $key1 => $value1) {
                array_push($drilldown['categories'], $value1);
                $dataAnggotaByStatus = $model->getAnggotaByStatus($value->id, $value1,"PERMATA");
                

                array_push($drilldown['color'], $color2[$key1]);
                array_push($drilldown['data'], count($dataAnggotaByStatus));
                $total = $total + count($dataAnggotaByStatus);
                
            }
            // echo json_encode($drilldown);die;
            $chart['y']         = $total;
            $chart['drilldown'] = $drilldown;
            $chart['color']     = $color1[$key];
            array_push($chartAnggota, $chart);
        }

        $result = array(
            "color" => $color1,
            "chart" => $chartAnggota
        );

        return $result;
    }


    // ARTIKEL
    public function artikel(){
        $title       = "PERMATA GBKP";
        $description = "Permata GBKP Runggun Tambun";
        return view('frontend.article',compact('title','description'));
    }

}
