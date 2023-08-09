<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
      // NOTIFICATION SENDER
      public $from_user;
      // NOTIFICATION RECEIVER
      public $to_users;
      // TYPE LIKE MODULE :. BOOKING, VOUCHER, FILE, PAYMENT ETC
      public $type;
      // JUST ROUTE NAME
      public $route;
      // JUST ONE PARAMETER ID
      public $params;
      // NOTIFICATION MESSAGE
      public $message;
  
      public function __construct($from_user = 0,$to_users = [],$type = '',$route = '',$params = 0,$message = '', $is_lead = '')
      {
          $this->from_user = $from_user;
          $this->to_users  = $to_users;
          $this->type      = $type;
          $this->route     = $route;
          $this->params    = $params;
          $this->message   = $message;
      }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
