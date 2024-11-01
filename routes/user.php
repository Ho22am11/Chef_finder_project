<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api','auth.guard:user'])->namespace('App\Http\Controllers\User')->group(function(){

    Route::post('/logout' , [ AuthController::class , 'logout']);
    Route::resource('orders' , ControllerOrder::class);
}); 

Route::post('auth/register' , [ AuthController::class , 'register']);
Route::post('auth/login' , [ AuthController::class , 'login']);



Route::get('/', function () {
    return 'welcome' ;
});
