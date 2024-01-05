<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'image1',
        'image2',
        'image3',
        'image4',
    ];

    protected $casts=[
        'image1'=>'string',
        'image2'=>'string',
        'image3'=>'string',
        'image4'=>'string',
    ];
}
