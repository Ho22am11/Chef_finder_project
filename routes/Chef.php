<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chef\AuthController ;




Route::middleware(['api','auth.guard:chef'])->namespace('App\Http\Controllers\Chef')->group(function(){
    Route::resource('profiles' , ControllerProfileChef::class);
    Route::resource('loctions' , ControllerLoctionChef::class);
    Route::resource('calendars' , ControllerCalendarChef::class);
    Route::resource('payments' , ControllerPaymentChef::class);
    Route::resource('menus' , ControllerMenusChef::class);
}); 

Route::post('/register' , [ AuthController::class , 'register']);

Route::get('/', function () {
    return 'welcomedd' ;
});
