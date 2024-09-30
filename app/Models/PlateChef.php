<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MenusChef;


class PlateChef extends Model
{
    use HasFactory;

    protected $fillable = ['customization' , 'name_plate' , 'Appetizer' , 'menus_id'] ;

    protected $casts = [
        'Appetizer' => 'array' ,
    ] ;

    

}
