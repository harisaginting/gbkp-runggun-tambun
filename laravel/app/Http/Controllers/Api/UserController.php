<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Harisa;
use Auth;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function get(Request $req){
        $model  = new Anggota();
        $user   = $model->get_anggota($req->user["email"]);
        return Harisa::apiResponse(200, $user, 'success');
    }

    function update(Request $req){
        $user = $req->user;
        $data = $req->data;

        $updatedata = array();

        foreach ($data as $key => $value) {
            if(!empty($value)){
                $updatedata[$key] = $value;
            }
        }

        if(!empty($updatedata["nama_depan"]) && !empty($updatedata["nama_belakang"])){
            $updatedata["nama"] = $updatedata["nama_depan"]." ".$updatedata["nama_belakang"];
        }

        if(Anggota::where('email',$user["email"])->update($updatedata)){
            $model  = new Anggota();
            $user   = $model->get_anggota($user["email"]);
            return Harisa::apiResponse(200, $user, 'success');
        }else{
            return Harisa::apiResponse(401, null, 'Bad Request');
        }
        

        return $data;

    }
    
}
