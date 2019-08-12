<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Http\Traits\ErrorLogTrait;

class NotificationController extends Controller
{
    use ErrorLogTrait;

    public function loadNotificationByUserId(Request $request){
        $userId = $request->userId;

        try{
            $notificationList = Notification::where('user_id', $userId)
                                            ->orderBy('created_at', 'DESC')
                                            ->get();

            return response()->json(['status' => 'OK', 'result' => $notificationList]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/loadNotificationByUserId', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu powiadomień.']);
        }
    }

    public function addNotification(Request $request){
        $type = $request->type;
        $message = $request->message;
        $userId = $request->userId;
        $senderId = $request->senderId;
        $openDetailsId = $request->openDetailsId;

        $newNotification = new Notification();

        try{
            $newNotification->type = $type;
            $newNotification->message = $message;
            $newNotification->user_id = $userId;
            $newNotification->sender_id = $senderId;
            $newNotification->open_details_id = $openDetailsId;
            $newNotification->status = 0;
    
            $newNotification->save();

            return response()->json(['status' => 'OK', 'result' => $newNotification]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/addNotification', $e->getMessage());

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
            $this->storeErrorLog($request->userId, '/clearNotificationByUserId', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy czyszczeniu powiadomień']);
        }
    }
}
