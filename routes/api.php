<?php

use App\Http\Controllers\Simple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/data',[Simple::class,'index']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
