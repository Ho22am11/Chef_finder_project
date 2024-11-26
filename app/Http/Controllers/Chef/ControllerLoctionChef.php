<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LocationChef;

use App\Traits\ApiResponseTrait;

  
class ControllerLoctionChef extends Controller
{

    use ApiResponseTrait ;

    public function store(Request $request)
    {
        try{
        $modifiedRequest = $request->all();
        $modifiedRequest['chef_id'] = 1 ;

        $loction = LocationChef::create($modifiedRequest);

        return $this->ApiResponse($loction , 'store successfully loction' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

    public function show( $id)
    {
        try{
        $loction = LocationChef::where('chef_id' , $id)->get();

        return $this->ApiResponse($loction , 'show successfully loction' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

    public function update(Request $request, $id)
    {
        try{
        $loction = LocationChef::findOrfail($id);
        $loction->update($request->all());

        
        return $this->ApiResponse($loction , 'update successfully loction' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

}
