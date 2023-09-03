<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function loadNotifications(Request $request)
    {
        $data = ['notify_counts' => 0, 'notify_body' => ''];

        if($request->ajax())
        {
            $notify = new Notification;

            $notify_list = $notify->getUserNotification();
            $notify_list_count = $notify_list->where('is_seen',0);

            $data['body'] = view('notifications.show_notification',[

                'notify_list' => $notify_list,

            ])->render();

            $data['notification_count'] = $notify_list_count;
        }

        return $data;
    }

    public function seenNotification(Request $request)
    {
        $data = ['notification_count' => 0, 'body' => ''];

        try{

            if($request->ajax())
            {
                $notify = new Notification;

                $notify->updateNotificationSeen(decrypt($request->id));

                $data = $this->loadNotifications($request);
            }
        }
        catch (DecryptException $e) 
        {

        }

        return $data;
    }


    public function appearNotification(Request $request)
    {
        $notify = new Notification;

        $notify->updateNotificationAppear();
    }

}
