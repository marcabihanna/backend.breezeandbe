<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;


    protected $casts = [
        'gallery_image' => 'json',
        'status' => 'boolean',
        'price' => 'double',
        'title'=> 'string',
        'home_description'=>'string',
        'home_image'=>'string',
        'benefits'=>'string',
        'description'=>'string',
        'size'=>'string',
        'key_featured'=>'json',
        'featured_ingredients'=>'string',
        'preview_image' => 'string'

    ];

    protected $fillable = [
        'title',
        'home_description',
        'home_image',
        'gallery_image',
        'benefits',
        'description',
        'size',
        'key_featured',
        'featured_ingredients',
        'price',
        'status',
        'preview_image'
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

    public function orderDetail():object{
        return $this->hasMany(OrderDetail::class);
    }
}
