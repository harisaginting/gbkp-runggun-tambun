<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Mail;
use Harisa;
use Session;



class EmailController extends Controller
{

    public function index()
    {   
        $pekerjaan  = Harisa::get_pekerjaan();
        $sektor     = Harisa::get_sektor();
        $marga      = Harisa::get_marga();
        return view('email.index',compact('sektor','marga','pekerjaan'));
    }


    public function test()
    {   
        $data = array();
        Mail::send('email.test', array(), function($message) use ($data){     
                $message->to('harisaginting@gmail.com', 'harisaaa')->subject("TEST EMAIL ");
                $message->cc(array('harisaginting@gmail.com'));
                $message->from('gbkprungguntambun@gmail.com','GBKP RUNGGUN TAMBUN');
            });

        echo "success";
    }


    public function sendEmailBirthday()
    {   
        $user       = Anggota::whereNotNull("email")->whereNotNull("tanggal_lahir")->whereRaw("MONTH(tanggal_lahir) = ".date('m'))->whereRaw("DAY(tanggal_lahir) = ".date('d'))->get()->toArray();
        // echo date_default_timezone_get(); die;
        // echo date("H:i:s")." bulan : ".date("m")." tanggal".date('d');die;
        // echo json_encode($user);die;
        foreach ($user as $key => $value) {
             $model     = new Anggota();
             $data      = $model->getAnggota($value["email"]);
              // echo  json_encode($data);die;
             // return view('email.birthday',compact('data'));
             $dataArr   = json_decode(json_encode($data),true); 
             Mail::send('email.birthday', $dataArr, function($message) use ($data){     
                $message->to($data->email, $data->nama_depan)->subject("Selamat Ulang Tahun ".$data->nama_depan);
                $message->cc(array('gbkp.tambun@gmail.com','harisaginting@gmail.com','nellaaginta@gmail.com','mikhatarigan28@gmail.com'));
                $message->from('gbkprungguntambun@gmail.com','GBKP RUNGGUN TAMBUN');
            });
        }

        echo "success";
    }

















    public function sendEmailBroadcast(Request $r)
    {   
        $user       = Anggota::whereNotNull("email")->get()->toArray();
        $body       = $r->input("emailBody");
        $subject    = $r->input("subject");
        foreach ($user as $key => $value) {
             $model = new Anggota();
             $data  = $model->get_anggota($value["email"]);

             $dataArr           = json_decode(json_encode($data),true); 
             $dataArr["pesan"]  = $body;

             Mail::send('email.broadcast', $dataArr, function($message) use ($data,$subject) {     
                $message->to($data->email, $data->nama_depan)->subject($subject);
                $message->cc(array('harisaginting@gmail.com'));
                $message->from('informasi@kitapermata.com','PERMATA GBKP RUNGGUN TAMBUN');
            });
        }
    }

    public function sendEmailMinggu()
    {   
        $user       = Anggota::whereNotNull("email")->get()->toArray();
        // $user       = Anggota::whereNotNull("email")->where("email","harisaginting@gmail.com")->get()->toArray();

        foreach ($user as $key => $value) {
             $model     = new Anggota();
             $data      = $model->get_anggota($value["email"]);
             $dataArr   = json_decode(json_encode($data),true); 

             Mail::send('email.selamat-hari-minggu', $dataArr, function($message) use ($data){     
                $message->to($data->email, $data->nama_depan)->subject("SELAMAT HARI MINGGU ".$data->nama_depan." :) ");
                $message->cc(array('harisaginting@gmail.com'));
                $message->from('informasi@kitapermata.com','PERMATA GBKP RUNGGUN TAMBUN');
            });
        }

        echo "success";
    }

    public function sendEmailTest()
    {   
        $user       = Anggota::whereNotNull("email")->get()->toArray();
        // $user       = Anggota::whereNotNull("email")->where("email","harisaginting@gmail.com")->get()->toArray();
        foreach ($user as $key => $value) {

             $model     = new Anggota();
             $data      = $model->get_anggota($value["email"]);
             // echo json_encode($data);die;
             $dataArr   = json_decode(json_encode($data),true); 
             Mail::send('email.custom', $dataArr, function($message) use ($data){     
                $message->to($data->email, $data->nama_depan)->subject("==[EVENT CERITA KITA]==");
                $message->cc(array('harisaginting@gmail.com'));
                $message->from('informasi@kitapermata.com','PERMATA GBKP RUNGGUN TAMBUN');
            });
        }

        echo "success";
    }
    
}
