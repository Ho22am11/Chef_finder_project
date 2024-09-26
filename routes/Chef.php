<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chef\AuthController;
use App\Http\Controllers\Chef\ControllerProfileChef;
use App\Http\Controllers\Chef\ControllerLoctionChef;



Route::middleware(['api','auth.guard:chef'])->group(function(){
    Route::resource('profiles' , ControllerProfileChef::class);
    Route::resource('loctions' , ControllerLoctionChef::class);
}); 

Route::post('/register' , [ AuthController::class , 'register']);

Route::get('/', function () {
    return 'welcomedd' ;
});
