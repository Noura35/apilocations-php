<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;

use function Laravel\Prompts\error;

class APILoginController extends Controller
{
    public function login(Request $request){

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password'=> 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
    

            $credentilas=$request->only('email','password');

            try{

                if(! $token= JWTAuth::attempt($credentilas)){

                    return response()->json(['error'=>'invalid username & password'],[401]);

                }

            }catch(JWTException $e){
                return response()->json(['error'=>"could not create token"],[500]);

            }



            return response()->json(compact('token'));        


           
    }


    
    
}
