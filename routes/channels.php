<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    // تحقق من أن المستخدم هو مالك الطلب
    $order = App\Models\Order::find($orderId);
    
    // تحقق من أن الطلب موجود وأن المستخدم هو مالكه
    return $order && $user->id === $order->user_id;
});
