<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;


    public function getUserNotification()
    {
        return Notification::where('is_seen',0)->whereJsonContains('to_user_id',Auth::user()->id)->orderBy('id','desc')->take(50)->get();
    }


    public function getUserNotificationDatatable()
    {
        return Notification::where('user_id', Auth::user()->id)->orderBy('id','desc')->take(50)->get();
    }


    public function updateNotificationSeen($id)
    {
        return Notification::where('id',$id)->update(['is_seen' => 1]);
    }

    public function updateNotificationAppear()
    {
        return Notification::where('is_appear',0)->whereJsonContains('to_user_id',Auth::user()->id)->update(['is_appear' => 1]);
    }

    public function storeNotification($event)
    {   
        return DB::transaction(function() use ($event){

            $receiver_ids = $event->to_users;

            if(@count($receiver_ids) > 0)
            {
                foreach($receiver_ids as $user_id)
                {
                    $notify = new Notification;

                    $notify->from_user_id = $event->from_user;
                    $notify->to_user_id   = $event->to_users;  
                    $notify->user_id      = $user_id;
                    $notify->route        = $event->route;
                    $notify->params       = $event->params; 
                    $notify->message      = $event->message;
                    $notify->save();
                }
            }
           
            return with($notify);
        });
    }

}
