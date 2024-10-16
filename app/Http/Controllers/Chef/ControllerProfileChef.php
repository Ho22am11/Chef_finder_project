<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileChef;
use Illuminate\Support\Facades\Auth;

use App\Traits\ApiResponseTrait;

class ControllerProfileChef extends Controller
{
    use ApiResponseTrait ;
  

    public function store(Request $request)
    {
        try{
        $modifiedRequest = $request->all();
        $modifiedRequest['chef_id'] = 2; //auth()->user()->id 
       $profile =  ProfileChef::create( $modifiedRequest);

       return $this->ApiResponse($profile , 'store successfully profile' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
       
    

    }

    public function show($id)
    {
        try{
        $profilechef = ProfileChef::where('chef_id' , $id)->get();
        return $this->ApiResponse($profilechef , 'show successfully profile' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }

    }

    public function update(Request $request, $id)
    {
        try{
        $profile = ProfileChef::find($id);
        $profile->update($request->all());
        return $this->ApiResponse($profile , 'update successfully profile' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

}
