<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Traits\ApiResponseTrait;

class ControllerOrder extends Controller
{
    use ApiResponseTrait ;
   
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = 1 ;
        $order = Order::create($data);

        return $this->ApiResponse($order , 'store successfully order' , 201);

    }


    public function show($id)
    {
        $order = Order::findOrfail($id);
        return $this->ApiResponse($order , 'show successfully order' , 201);
    }


    public function update(Request $request, $id)
    {
        $order = Order::findOrfail($id);
        $order->update($request->all());
        return $this->ApiResponse($order , 'update successfully order' , 201);
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return $this->ApiResponse(null , 'cancel successfully order' , 201);
    }
}
