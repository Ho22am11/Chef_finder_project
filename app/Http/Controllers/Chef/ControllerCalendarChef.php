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
        $modifiedRequest = $request->all();
        $modifiedRequest['chef_id'] = 1 ;
        $calendar = CalendarChef::create( $modifiedRequest);
        
        return $this->ApiResponse($loction , 'store successfully calendar' , 201);
    }

    public function show(Request $request , $id)
    {
        $availability = CalendarChef::where('chef_id', $id)->whereMonth('day', $request->month)->whereYear('day', $request->year)->get();
        return $this->ApiResponse($availability , 'show successfully calendar' , 201);

    }

    public function edit(Request $request , $id)
    {
        $availability = CalendarChef::where('chef_id', $id)->where('day', $request->day)->first();
        return $this->ApiResponse($availability , 'show successfully calendar' , 201);
    }

    public function update(Request $request, $id)
    {
        $calendar = CalendarChef::findOrFail($id);
        $calendar->update($request->all());
        return $this->ApiResponse($calendar , 'update successfully calendar' , 201);
    }

}
