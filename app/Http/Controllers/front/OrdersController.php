<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function delivery(order $order) {
        // $delivery = $order->delivery()->select([
        //     'id', 'order_id', 'status', 'lat', 'lng'
        // ])->first();
    
    
        return view('front.orders.show', [
            'order' => $order,
            // 'delivery' => $delivery
        ]);
    }
    
}
