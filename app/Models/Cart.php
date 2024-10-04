<?php

namespace App\Models;

use App\Observers\CartObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;


    public $incrementing = false;


    public $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'options',
        'cookie_id'
    ];

    protected static function booted()
    {

        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=',  cart::getCookieId());
        });

        static::observe(CartObserver::class);
        // static::creating(function (Cart $cart) {
        //     $cart->id = str::uuid();
        // });
    }

    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = (string) Str::uuid();
            $minutes = Carbon::now()->diffInMinutes(Carbon::now()->addDays(30));
            cookie::queue('cart_id', $cookie_id, $minutes);
        }
        return $cookie_id;
    }



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'guest',
        ]);
    }




    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
