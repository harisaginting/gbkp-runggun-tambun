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

class AuthController extends Controller
{
     public $status = array(
     	'success' 	=> 	200,
     	'notfound'	=>	404
     );

##REGISTER
    public function register(Request $request)
    {	
    	 $requestData 	= $request->json()->all();
    	 $validator 	= Validator::make($requestData, [ 
	              'firstname' 	=> 'required',
	              'lastname' 	=> 'required',
	              'email' 		=> 'required|email',
	              'password' 	=> 'required',    
	              'c_password' 	=> 'required|same:password', 
	              'runggun' 	=> 'required',  
	              'marga' 		=> 'required',
	    ]); 

		if($validator->fails()) {          
			return Harisa::apiResponse(401, $validator->errors(), 'not valid request' );
	   	}


    	$isExist 				= Anggota::where('email', $request->input('email'))->first();

    	
    	$result['result'] 		= 'error';
        $urlActivation 			= str_replace('-', '',Uuid::uuid4()).$requestData["email"];
        $urlResetPassword 		= str_replace('-', '',Uuid::uuid4()).$requestData["email"];
        $fullname 				= ucwords($requestData["firstname"]). " ".ucwords($requestData["lastname"]);

        if(!empty($isExist)){
        	return Harisa::apiResponse(401, null, 'user already registered');
        }else{       	
        	$member = new Anggota;
        	$member->nama 	    		= $fullname;
        	$member->nama_depan 	    = ucwords($requestData["firstname"]);
        	$member->nama_belakang 	    = ucwords($requestData["lastname"]);
        	$member->email 		        = strtolower($request->input('email'));
        	$member->password 	        = Hash::make($request->input('password'));
        	$member->url_activation		= $urlActivation;
        	$member->url_reset_password	= $urlResetPassword;
        	$member->runggun	        = strtoupper($request->input('runggun'));
        	$member->marga	        	= strtolower($request->input('marga'));
        	$member->created_at 	    = Carbon::now();
        	$member->updated_at 	    = Carbon::now();
        	$member->save();

        	$this->sendEmailRegister($requestData["email"],$fullname,$urlActivation);	
      		return Harisa::apiResponse(200, array('nama' => $fullname), 'success register');
        }
    }

    function sendEmailRegister($email,$name,$urlActivation){
        $to_name    = $name;
        $to_email   = array($email);
        $monitoring = array('harisaginting@gmail.com','konsolidasi@kitapermata.com');
        $data       = array('name' => $name, 'url_validation' => $urlActivation);

        return Mail::send('email.register', $data, function($message) use ($to_name, $to_email,$data,$monitoring) {     
            $message->to($to_email, $to_name)->subject('Mejuah-juah '.ucwords($data['name']));
            $message->cc($monitoring);
            $message->from('kitapermatagbkp@gmail.com','PERMATA GBKP RUNGGUN TAMBUN');
        });
    }
##END REGISTER

##LOGIN
    function login(Request $req){
        $requestData    = $req->json()->all();
        $cek            = Anggota::where('email','=',$requestData["email"])->first();
        if(!empty($cek)){
            if (Hash::check($requestData["password"], $cek->password)) {
                $model  = new Anggota();
                $user   = $model->get_anggota($requestData["email"]);
                $token          = str_replace('-', '',Uuid::uuid4()).date('dmY'); 
                $updatedToken   = Anggota::where('email', $user->email)->update(['token' => $token ]);

                if($user->status == "TERDAFTAR"){
                    return Harisa::apiResponse(401, null, 'not activated');    
                }
                return Harisa::apiResponse(200, array('token'=> $token, 'user' => $user), 'success login');
            }else{
              return Harisa::apiResponse(401,  null , 'wrong password');  
            }
        }else{
                return Harisa::apiResponse(401,  null , 'email not found');
        }

    }
##END LOGIN
    
}
