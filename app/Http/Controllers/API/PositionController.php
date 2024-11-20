<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use  App\Models\Position;
use Illuminate\Support\Facades\Validator;
 



class PositionController extends BaseController
{



public function index(){
    $positions=Position::all();
    return $this->sendResponse($positions->toArray(),"positions read successfully");
}


public function store(Request $request){
   $input=$request->all();
   $validator =Validator::make($input,
   [
    'pseudo'=>'required',
    'numero'=>'required',
    'latitude'=>'required',
    'longitude'=>'required',
   ]);

   if($validator->fails()){
    return $this->sendError('Error validation',$validator->errors());
   }

   $position=Position::create($input);

   return $this->sendResponse($position->toArray(),"position created successfully");


}



public function show($id){

    $position=Position::find($id);

    if(is_null($position)){
        return $this->sendError('Position not found ');

    }
 
 
    return $this->sendResponse($position->toArray(),"position read successfully");
 
 
 }


//update position
public function update(Request $request ,Position $position){
    
    $input=$request->all();
    $validator =Validator::make($input,
    [
     'pseudo'=>'required',
     'numero'=>'required'
    
    ]);
 
    if($validator->fails()){
     return $this->sendError('Error validation',$validator->errors());
    }
 
    $position->pseudo=$input['pseudo'];
    $position->numero=$input['numero'];
    $position->save();

 
    return $this->sendResponse($position->toArray(),"position updated successfully");
 
 
 }
 

//delete position
public function destroy (Position $position){
    

    $position->delete();
 
    return $this->sendResponse($position->toArray(),"position deleted successfully");
 
 }




}