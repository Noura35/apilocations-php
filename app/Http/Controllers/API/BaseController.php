<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;



class BaseController extends Controller
{
  
  
    public function sendResponse($result,$message){


            $response=[
                'success' => 1,
                'positions' => $result,
                'message'=> $message
            ];    
            
            
            return response()->json($response,200);

           
    }



    public function sendError($error,$errorMessage=[],$code=404){


        $response=[
            'success' => 0,
            'message'=> $error
        ];    
        
        if(!empty($errorMessage)){
            $response['positions']=$errorMessage;
        }




        return response()->json($response,$code);

       
}



    
    
}
