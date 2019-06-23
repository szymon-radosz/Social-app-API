<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function loadNotificationByUserId(Request $request){
        $userId = $request->userId;

        try{
            $notificationList = Notification::where('user_id', $userId)
                                            ->orderBy('created_at', 'DESC')
                                            ->get();

            return response()->json(['status' => 'OK', 'result' => $notificationList]);
        }catch(\Exception $e){
            //return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu listy postów.']);
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }

    public function addNotification(Request $request){
        $type = $request->type;
        $message = $request->message;
        $userId = $request->userId;

        $newNotification = new Notification();

        try{
            $newNotification->type = $type;
            $newNotification->message = $message;
            $newNotification->user_id = $userId;
            $newNotification->status = 0;
    
            $newNotification->save();

            return response()->json(['status' => 'OK', 'result' => $newNotification]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie powiadomienia.']);
        }
    }

    public function clearNotificationByUserId(Request $request){
        $userId = $request->userId;

        try{
            $notificationList = Notification::where('user_id', $userId)
                                                ->update(['status' => 1]);;

            return response()->json(['status' => 'OK', 'result' => $notificationList]);
        }catch(\Exception $e){
            //return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu listy postów.']);
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }
}
