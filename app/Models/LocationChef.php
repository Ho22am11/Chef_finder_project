<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationChef extends Model
{
    use HasFactory;

    protected $fillable = ['chef_id' , 'longitude' , 'latitude'] ;
}
