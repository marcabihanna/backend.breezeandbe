<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'discount',
    ];

    protected $casts=[
        'uuid'=>'string',
        'code'=>'string',
        'discount'=>'integer',
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


    public function order(){
        return $this->hasMany(Order::class);
    }

}
