<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileChef extends Model
{
    use HasFactory;

    protected $fillable = [
        'f_name',
        'l_name',
        'BIO',
        'lang',
        'about',
        'experience',
        'learned_at',
        'guides',
        'web',
        'face',
        'insta',
        'Twitter',
        'youtube',
        'linkedin',
        'chef_id' ,
    ];



    protected $casts = [
        'lang' => 'array' ,
    ] ;
}
