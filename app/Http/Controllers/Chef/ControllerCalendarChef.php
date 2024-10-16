<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalendarChef;

use App\Traits\ApiResponseTrait;

class ControllerCalendarChef extends Controller
{
    use ApiResponseTrait ;


    public function store(Request $request)
    {
        try{
        $modifiedRequest = $request->all();
        $modifiedRequest['chef_id'] = 1 ;
        $calendar = CalendarChef::create( $modifiedRequest);
        
        return $this->ApiResponse($loction , 'store successfully calendar' , 201);

    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

    public function show(Request $request , $id)
    {
        try{
        $availability = CalendarChef::where('chef_id', $id)->whereMonth('day', $request->month)->whereYear('day', $request->year)->get();
        return $this->ApiResponse($availability , 'show successfully calendar' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }

    }

    public function edit(Request $request , $id)
    {
        try{
        $availability = CalendarChef::where('chef_id', $id)->where('day', $request->day)->first();
        return $this->ApiResponse($availability , 'show successfully calendar' , 201);
    }catch(\Exception $e){
        return response()->json([
        'error' => 'Something went wrong',
        'message' => $e->getMessage()], 500);
    }
    }

    public function update(Request $request, $id)
    {
        try{
        $calendar = CalendarChef::findOrFail($id);
        $calendar->update($request->all());
        return $this->ApiResponse($calendar , 'update successfully calendar' , 201);}catch(\Exception $e){
            return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()], 500);
        }

    }

}
