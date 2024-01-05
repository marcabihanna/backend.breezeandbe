<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'slug',
        'description',
        'title_description',
        'image',
        'video',
        'button_text',
        'button_url',
      'description2'
    ];

    protected $casts=[
        'page'=>'string',
        'slug'=>'string',
        'description' =>'string',
        'title_description'=>'string',
        'image'=>'string',
        'video'=>'string',
        'button_text'=>'string',
        'button_url'=>'string',
        'description2'=>'string'
    ];

}
