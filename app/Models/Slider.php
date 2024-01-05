<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'images', 'text', 'page','uuid','title'
    ];

    protected $casts=[
        'images'=> 'json',
        'text' => 'string',
        'page' =>'string',
        'uuid'=>'string',
        'title'=>'string'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }
}
