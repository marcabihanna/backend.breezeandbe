<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phone',
        'phone2',
        'facebook',
        'you_tube',
        'instagram',
        'tik_tok',
        'linked_in',
    ];

    protected $casts=[
        'email'=>'string',
        'phone'=>'string',
        'phone2'=>'string',
        'facebook'=>'string',
        'you_tube'=>'string',
        'instagram'=>'string',
        'tik_tok'=>'string',
        'linked_in'=>'string',
    ];
}
