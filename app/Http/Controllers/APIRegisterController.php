<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Response;



class APIRegisterController extends BaseController
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation',$validator->errors());
            
        }

        // Créer l'utilisateur et récupérer l'objet créé
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password'=> bcrypt($request->get('password')),
        ]);

        // Générer le token pour cet utilisateur
        $token = JWTAuth::fromUser($user);

        
        return $this->sendResponse($token,"user created successfully");
       
    }
}
