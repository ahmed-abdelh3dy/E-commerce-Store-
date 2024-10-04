<?php

namespace App\Listeners;

use App\Events\OrederCreated;
use App\Models\User;
use App\Notifications\OrderCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrederCreated $event): void
    {
        $order= $event->order;
        $user =User::where('store_id',$order->store_id)->first(); 
        $user->notify(new OrderCreateNotification($order));
    }
}
