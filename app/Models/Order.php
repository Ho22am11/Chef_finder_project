<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'service' ,
        'state' ,
        'Adults' ,
        'Teens' ,
        'Children' ,
        'Cuisines' ,
        'meal' ,
        'day' ,
        'Packages' ,
        'Additional_service' , 
        'user_id' , 
        'chef_id' , 
    ];
}
