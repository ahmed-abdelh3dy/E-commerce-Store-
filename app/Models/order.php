<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Delivery;

use function PHPSTORM_META\type;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'status',
        'payment_status',
        'payment_method'
    ];


    public function store()
    {
        $this->belongsTo(store::class);
    }

    public function delivery(){
        return $this->hasOne(Delivery::class);
    } 

    public function products()
    {
        $this->belongsToMany(Product::class, 'Order_items', 'order_id', 'product_id', 'id', 'id')
        // عشان اعمل  using Pivot ل اي مودل لازم يكون مستخدم 
            ->using(OrderItem::class)
            ->withPivot([
                'product_name',
                'quantity',
                'price',
                'options'
            ]);
    }

    public function items(){
        $this->hasMany(OrderItem::class,'order_id');
    }

    public function user()
    {
        $this->belongsTo(user::class)->withDefault([
            'name' => 'Guest Customer',
        ]);
    }

    public function address()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id' , 'id')
        ->where('type' , '=' , 'billing');
    }


    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class , 'order_id' , 'id')
        ->where('type' , '=' , 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (order $order) {
            $order->number = order::getNextOrderNumber();
        });
    }


    public static function getNextOrderNumber()
    {

        $year = Carbon::now()->year;
        $number = order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year   . '000001';
    }
}
