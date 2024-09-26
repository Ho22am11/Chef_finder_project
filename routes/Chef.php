<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chef\AuthController;
use App\Http\Controllers\Chef\ControllerProfileChef;



Route::middleware(['api','auth.guard:chef'])->group(function(){
    Route::resource('profiles' , ControllerProfileChef::class);
}); 

Route::post('/register' , [ AuthController::class , 'register']);

Route::get('/', function () {
    return 'welcomedd' ;
});
