<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Response;



class APIRegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Créer l'utilisateur et récupérer l'objet créé
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password'=> bcrypt($request->get('password')),
        ]);

        // Générer le token pour cet utilisateur
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));        
    }
}
