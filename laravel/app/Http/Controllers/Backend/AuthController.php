<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Harisa;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Session;
use DB;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    function index()
    {   
        echo "No Direct Access Allowed";die();
    }

    function login(){
        // echo Hash::make('permatatambun');die;
        if(Session::get('isLogin') != 1){
            return view('backend.auth.login');
        }else{
            return redirect('app');
        }
        
    }

    function loginProcess(Request $req){
        $requestData    = $req->json()->all();
        $model          = new Anggota();
        $userCek        = $model->getAnggota($requestData["email"]);
        if(!empty($userCek)){
            $user = Anggota::whereUuid($userCek->uuid)->first();
            if (Hash::check($requestData["password"], $user->password)) {
                
                $token          = str_replace('-', '',Uuid::uuid4()).date('dmY'); 
                $updatedToken   = Anggota::where('email', $user->email)->update(['token' => $token ]);

                if($user->role == 0 ){
                    if(!empty($user->confimation)){
                        return Harisa::apiResponse(401, null, 'not activated');    
                    }
                }
                return Harisa::apiResponse(200, array('token'=> $token, 'user' => $model->getAnggota($requestData["email"],1,null)), 'success login');
            }else{
              return Harisa::apiResponse(401,  null , 'wrong password');  
            }
        }else{
                return Harisa::apiResponse(401,  null , 'email not found');
        }

    }

    function validate_login($email,$password){
        $result     = false;
        $user     = DB::table('anggota as user') 
                                ->select('user.*','user.id as id_anggota','m_role.nama as role_name','user.role as role_id')
                                ->join('m_role','m_role.id','=','user.role')
                                ->where('user.role',1)
                                ->where('user.email','=',$email)
                                ->first();

        if(!empty($user)){
            if (Hash::check($password, $user->password)) {
                foreach ($user as $key => $value) {
                        Session::put($key,$value);
                }
                Session::put('isLogin',1);
                $result = true;
            }
        }
        return $result;
    }

    function checkEmailAvaliable(Request $request){
        $email = $request->input('email');
        $q = DB::table('anggota')->select(DB::raw('count(id) as total'))->WhereRaw("UPPER(email) like '%".strtoupper($email)."%'")->first();
        $data['result'] = 'unavailable';
        if($q->total > 0 ){
            $data['result'] = 'available';
        }
        echo json_encode($data);

    }

    function validateToken($token){
        $user   = Anggota::where('token' , strtolower($token))->where('role','1')->first();
        if(!empty($token) && !empty($user)){
            $user  = $user->toArray();
            return Harisa::apiResponse(200, array('token'=> $token,'nama' => $user["username"]), 'token is valid');    
        }else{
            return Harisa::apiResponse(408, null, 'Unauthorized');
        }
    }

}
