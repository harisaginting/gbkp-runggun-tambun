<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Ramsey\Uuid\Uuid;
use Harisa;
use DB;

class UtilityController extends Controller
{







































    

    public function refreshUserData()
    {   
        $user       = Anggota::all()->toArray();
        foreach ($user as $key => $value) {
            $updateData = array(
                'url_reset_password' => str_replace('-', '',Uuid::uuid4()).$value["email"],
                'url_reset_password' => str_replace('-', '',Uuid::uuid4()).$value["email"],
            );
            Anggota::where('email',$value["email"])->update($updateData);
        }
        echo "success";
    }
    



    public function migrasiFixUsernameTypo()
    {
        $data = DB::table("anggota")->select("*")->whereNotNull("username")->get()->toArray();
        
        // $username = DB::table("anggota")->select("*")->whereNotNull("username")->get()->toArray();
        // $usernameArr = array();
        // foreach ($username as $key => $value) {
            // array_push($usernameArr, $value->username);
        // }

        foreach ($data as $key => $value) {
            // if(!in_array(strtolower($value->nama_depan).strtolower($value->nama_belakang) , $usernameArr) ){
                $ava =  str_replace(" ","",strtolower($value->nama_depan).strtolower($value->nama_belakang).".png");
                DB::table("anggota")->whereUuid($value->uuid)->update(array('username' => str_replace(" ", "", $ava)));
            // }
        }
        $data2 = DB::table("anggota")->select("*")->whereUsername(null)->get()->toArray();
        echo json_encode($data2);
    }

    public function migrasiFixAvatar()
    {
        $data = DB::table("anggotanew")->select("*")->whereNotNull("avatar")->whereNotNull("email")->get()->toArray();

        foreach ($data as $key => $value) {
            // echo $value->avatar;die;
            $ava =  str_replace(" ","",strtolower($value->nama_depan).strtolower($value->nama_belakang).".png");
            if($this->base64_to_jpeg($value->avatar,$ava)){
                DB::table("anggota")->whereNotNull("email")->whereEmail($value->email)->update( array('avatar' => $ava));
            }             
        }
        $data2 = DB::table("anggota")->select("*")->whereAvatar(null)->get()->toArray();
        echo json_encode($data2);
    }

    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( base_path()."/../public/img/avatar/".$output_file, 'wb' ); 
        // $data = explode( ',', $base64_string );
        // fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fwrite( $ifp, base64_decode( $base64_string  ) );
        fclose( $ifp ); 
        return $output_file; 
    }

    public function migrasiFixUsername()
    {
         $data = DB::table("anggota")->select("*")->whereNotNull("username")->get()->toArray();
        
        // $username = DB::table("anggota")->select("*")->whereNotNull("username")->get()->toArray();
        // $usernameArr = array();
        // foreach ($username as $key => $value) {
            // array_push($usernameArr, $value->username);
        // }

        foreach ($data as $key => $value) {
            // if(!in_array(strtolower($value->nama_depan).strtolower($value->nama_belakang) , $usernameArr) ){
                DB::table("anggota")->whereUuid($value->uuid)->update(array('username' => str_replace(" ", "", $value->nama_depan)));
            // }
        }
        $data2 = DB::table("anggota")->select("*")->whereUsername(null)->get()->toArray();
        echo json_encode($data2);

       /* $data = DB::table("anggota")->select("*")->whereNull("username")->get()->toArray();
        
        $username = DB::table("anggota")->select("*")->whereNotNull("username")->get()->toArray();
        $usernameArr = array();
        foreach ($username as $key => $value) {
            array_push($usernameArr, $value->username);
        }

        foreach ($data as $key => $value) {
            if(!in_array(strtolower($value->nama_depan).strtolower($value->nama_belakang) , $usernameArr) ){
                DB::table("anggota")->whereUuid($value->uuid)->update(array('username' => strtolower($value->nama_depan).strtolower($value->nama_belakang)));
            }
        }
        $data2 = DB::table("anggota")->select("*")->whereUsername(null)->get()->toArray();
        echo json_encode($data2);*/
    }

}
