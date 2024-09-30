<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisheChef;
use App\Traits\ApiResponseTrait;


class ControllerDisheChef extends Controller
{
    use ApiResponseTrait ;


    public function store(Request $request)
    {
        $data = $request->all();
        $data['chef_id'] = 1 ;
        $dishe = DisheChef::create($data);
        return $this->ApiResponse($dishe , 'store successfully dishe' , 201);
    }

    public function show($id)
    {
        $dishes = DisheChef::where('chef_id' , $id)->get();
        return $this->ApiResponse($dishes , 'show successfully dishe' , 201);

    }

    public function edit($id)
    {
        $dishe = DisheChef::findOrfail( $id);
        return $this->ApiResponse($dishe , 'edit successfully dishe' , 201);

    }

    public function update(Request $request, string $id)
    {
        $dishe = DisheChef::findOrfail( $id);
        $dishe->update($request->all());
        return $this->ApiResponse($dishe , 'update successfully dishe' , 201);
    }

}