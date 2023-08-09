<?php

namespace App\Listeners;

use App\Events\SendNotification as EventsSendNotification;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Pusher\Pusher;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsSendNotification $event)
    {
        
           // SET PUSHER CONFIGURATIONS
           $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );
        // END PUSHER CONFIGURATION

        // STORE PUSER NOTIFICATION IN OUR SYSTEM
        if(@count($event->to_users) > 0)
        {


            $notify = new Notification;

            $notify = $notify->storeNotification($event);

            $pusher->trigger( 'my-channel', 'my-event', $notify->to_user_id);
        }
        
    }
}
