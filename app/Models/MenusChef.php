<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlateChef;

class MenusChef extends Model
{
    use HasFactory;
    
    protected $fillable = ['chef_id' , 'name_menu' , 'type_food' , 'min' , 'max' , 'price_2' , 'price_6' , 'price_20'] ;

    public function plates()
    {
        return $this->hasMany(PlateChef::class, 'menus_id');
    }
}
