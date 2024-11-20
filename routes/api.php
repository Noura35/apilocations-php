<?php

use App\Http\Controllers\Simple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIRegisterController;
use App\Http\Controllers\APILoginController;
use App\Http\Controllers\API\PositionController; 

Route::get('/data',[Simple::class,'index']);

Route::post('user/register',[APIRegisterController::class, 'register']);

Route::post('user/login', [APILoginController::class, 'login']);




Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    return auth()->user();

});




Route::middleware('jwt.auth')->group(function() {
    Route::resource('positions', PositionController::class); 
});
