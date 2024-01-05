<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'status',
    ];

    protected $casts=[
        'order_id'=>'integer',
        'product_id'=>'integer',
        'quantity'=>'integer',
        'status' => 'boolean'
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


    public function order():object
    {
        return $this->belongsTo(Order::class);
    }


    public function product():object
    {
        return $this->belongsTo(Product::class);
    }

}
