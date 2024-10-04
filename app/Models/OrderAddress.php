<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'street_address',
        'email',
        'city',
        'state',
        'postal_code',
        'country',
        'phone_number',
        'order_id',
        'type',
    ];
}
