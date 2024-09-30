<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenusChef;
use App\Models\PlateChef;
use App\Traits\ApiResponseTrait;


class ControllerMenusChef extends Controller
{
    use ApiResponseTrait ;

    public function store(Request $request)
    {
        $inputData = $request->except('menus');
        $inputData['chef_id'] = 2 ;

       $menuData = MenusChef::create($inputData);
        $menus = $request->input('menus');

        foreach($menus as $menu){
            $menu['menus_id'] = $menuData->id ;
            PlateChef::create($menu);
        }

        return $this->ApiResponse($menuData , 'store successfully menu' , 201);

    }

    public function show($id)
    {
        $menu = MenusChef::where('chef_id' , $id)->with('plates')->get() ; // error relation
        return $this->ApiResponse($menu , 'show successfully menu' , 201);
        
    }

    public function update(Request $request , $id)
    {
        $menuData = MenusChef::findOrfail($id);
        $inputData = $request->except('menus');
        $menuData->update($inputData);

        $menus = $request->input('menus');
        
        $i = 0 ;

        foreach ($menus as $menu) {
            $plates = PlateChef::where('menus_id', $id)->get();

            if ($i >= count($plates)) {
                
                $menu['menus_id'] = $id;
                PlateChef::create($menu);
            }else{
                $plates[$i]->update([
                    'name_plate' => $menu['name_plate'],
                    'customization' => $menu['customization'],
                    'Appetizer' => $menu['Appetizer']
                ]);

            }

           
            $i++ ;
            
        }
       
        return $this->ApiResponse($menuData , 'update successfully menu' , 201);
        
    }


}
