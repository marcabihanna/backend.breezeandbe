<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'country',
        'address',
        'status',
        'delivered',
        'in_progress',
        'total_price',
        'prefix_phone',
        'total_price_new',
        'coupon_id'
    ];


    protected $casts = [
        'status' => 'boolean',
        'delivered' => 'boolean',
        'in_progress' => 'boolean',
        'name'=>'string',
        'email'=>'string',
        'phone'=>'string',
        'city'=>'string',
        'country'=>'string',
        'address'=>'string',
        'total_price' =>'double',
        'prefix_phone' =>'string',
        'total_price_new'=>'string',
        'coupon_id'=>'integer'


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

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}
