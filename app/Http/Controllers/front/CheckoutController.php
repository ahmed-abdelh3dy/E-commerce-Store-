<?php

namespace App\Http\Controllers\front;

use App\Events\OrederCreated;
use App\Exceptions\invalidOrder;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\OrderItem;
use App\Repositories\cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            // return redirect()->route('home');

            throw new invalidOrder('cart is empty');
        }

        return view('front.checkout', [
            'cart'      => $cart,
            'countries' => Countries::getNames(),
        ]);
    }


    public function store(Request $request, CartRepository $cart)
    {

        $request->validate([]);


        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cartItems) {
                $order = order::create([
                    'store_id' => $store_id,
                    'user_id'  => Auth::id(),
                    'payment_method' => 'cod',
                ]);




                foreach ($cartItems as $item) {

                    OrderItem::create([
                        'quantity' => $item->quantity,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'order_id' => $order->id,
                        'price' => $item->product->price,

                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->address()->create($address);
                }
            }




            DB::commit();

            // event('order.created');
            
            // event(new OrederCreated($order));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('order.pay',$order->id);
    }
}
