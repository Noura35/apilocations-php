<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;

use function Laravel\Prompts\error;

class APILoginController extends BaseController
{
    public function login(Request $request){

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password'=> 'required'
            ]);
    
            if ($validator->fails()) {
                return $this->sendError('Error validation',$validator->errors());

            }
    

            $credentilas=$request->only('email','password');

            try{

                if(! $token= JWTAuth::attempt($credentilas)){

                    return $this->sendError('invalid username & password',$validator->errors());

                   // return response()->json(['error'=>'invalid username & password'],[401]);

                }

            }catch(JWTException $e){
               // return response()->json(['error'=>"could not create token"],[500]);
                return $this->sendError('could not create token',$validator->errors());


            }



            return $this->sendResponse($token,"login successfully");


           
    }


    
    
}
