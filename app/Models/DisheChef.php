<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisheChef extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'Cuisine',
        'chef_id' ,
    ];
}
