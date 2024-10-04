<?php

namespace App\facades;

use App\Repositories\cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade{

    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}