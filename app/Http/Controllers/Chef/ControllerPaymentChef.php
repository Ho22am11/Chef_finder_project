<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentChef;

use App\Traits\ApiResponseTrait;


class ControllerPaymentChef extends Controller
{
    use ApiResponseTrait ;

    public function store(Request $request)
    {
        try{
        $modifiedRequest = $request->all();
        $modifiedRequest['chef_id'] = 1 ;
        
        $PaymenyInformation = PaymentChef::create($modifiedRequest);
        return $this->ApiResponse($PaymenyInformation , 'store successfully Paymeny Information' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

    public function show( $id)
    {
        try{
        $PaymenyInformation = PaymentChef::where( 'chef_id' ,$id)->first();
        return $this->ApiResponse($PaymenyInformation , 'show successfully Paymeny Information ' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }


    public function update(Request $request,  $id)
    {
        try{
        $PaymenyInformation = PaymentChef::findOrfail($id);
        $PaymenyInformation->update($request->all());
        return $this->ApiResponse($PaymenyInformation , 'update successfully Paymeny Information ' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

}
