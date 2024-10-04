<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(order $order)
    {
        return view('front.payments.create', [
            'order' => $order
        ]);
    }


    // public function createPayment(order $order)
    // {
    //     $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    //     $amount = $order->items->sum(function ($item) {
    //         return $item->price * $item->quantity * 100;
    //     });

    //     $paymentIntent = $stripe->paymentIntents->create([
    //         'amount' => $amount,
    //         'currency' => 'usd',
    //         'automatic_payment_methods' => ['enabled' => true],
    //     ]);
    //     dd($paymentIntent);



    //     // return [
    //     //     'clientSecret' => $paymentIntent->client_secret,
    //     // ];

    //     return response()->json([
    //         'clientSecret' => $paymentIntent->client_secret,
    //     ]);
        
    // }

    public function createPayment(Order $order)
{
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    $amount = $order->items->sum(function ($item) {
        return $item->price * $item->quantity * 100;
    });

    try {
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function confirm(Request $request , order $order){
        dd($request->all());

    }
}
