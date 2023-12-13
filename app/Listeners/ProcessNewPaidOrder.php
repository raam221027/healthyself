<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewPaidOrder;
use Illuminate\Support\Facades\Broadcast;


class ProcessNewPaidOrder implements ShouldQueue
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
    public function handle(NewPaidOrder $event)
    {
        $order = $event->order;

        // Broadcast the event to the "kitchen" channel
        broadcast(new NewPaidOrder($order))->to('kitchen');
    }
}
