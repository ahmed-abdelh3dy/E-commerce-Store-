<?php

namespace App\Repositories\cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartModelRepository  implements CartRepository
{

    protected $items;

    public function __construct()
    {
        $this->items = collect();
    }


    public function get(): Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')
            ->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {

        $item = Cart::where('product_id', '=', $product->id)
        ->first();

        if (!$item) {
            // 
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);

            $this->get()->push($cart);
            return $cart;
        }

        return $item->increment('quantity' ,$quantity );
    }


    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity
            ]);
    }


    public function delete($id)
    {
        return Cart::where('product_id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()
        ->delete();
    }
    // public function total(): float
    // {
    //     return (float) Cart::where('cookie_id', '=', $this->getCookieId())
    //         ->join('products', 'products.id', '=', 'carts.products_id')
    //         ->selectRaw('sum(products.price * carts.quantity) as total')
    //         ->value('total');
    // }

    public function total(): float
    {
        // $total = Cart::join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('sum(products.price * carts.quantity) as total')
        //     ->value('total');

        // return $total ? (float) $total : 0.0;


// استخدام ال collection لتقليل الاستعلامات من الداتاا بيز

        return $this->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }





}