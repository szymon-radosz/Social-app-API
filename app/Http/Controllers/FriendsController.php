<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;

class FriendsController extends Controller
{
    public function checkFriend(Request $request){
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;

        try{
            $confirmed;

            //check if exists link between two users in friends table
            $friendship = Friend::where([['sender_id', $senderId], ['receiver_id', $receiverId]])
                                ->orWhere([['sender_id', $receiverId], ['receiver_id', $senderId]])
                                ->first();

            //var_dump([$friendship == null]);

            //friendship confirmed
            if($friendship != null && $friendship->confirmed == 1){
                $confirmed = 'confirmed';
            }
            //friendship exists, not confirmed, second person not confirmed
            else if($friendship != null && $friendship->confirmed == 0 && $friendship->sender_id == $senderId){
                $confirmed = 'not confirmed by second person';
            }
            //friendship exists, not confirmed, first person not confirmed
            else if($friendship != null && $friendship->confirmed == 0 && $friendship->sender_id == $receiverId){
                $confirmed = 'not confirmed by first person';
            }
            //firendship didnt exist
            else{
                $confirmed = 'friendship doesnt exist';
            }

            return response()->json(['status' => 'OK', 'result' => ['friendship' => $confirmed]]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy potwierdzeniu zaproszenia do znajomych.']);
        }
    }

    public function inviteFriend(Request $request){
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;
        $confirmed = false;

        //var_dump([$senderId, $receiverId]);

        try{
            $friendship = new Friend();

            $friendship->sender_id = $senderId;
            $friendship->receiver_id = $receiverId;
            $friendship->confirmed = $confirmed;

            $friendship->save();

            return response()->json(['status' => 'OK', 'result' => $friendship]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zaproszeniu do znajomych.']);
        }
    }

    public function confirmFriend(Request $request){
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;

        try{
            $confirmed;

            //check if exists link between two users in friends table
            $friendship = Friend::where([['sender_id', $senderId], ['receiver_id', $receiverId]])
                                ->orWhere([['sender_id', $receiverId], ['receiver_id', $senderId]])
                                ->update(['confirmed' => true]);

            //friendship confirmed
            if($friendship != null){
                $confirmed = true;
            }
            //firendship didnt exist
            else{
                $confirmed = false;
            }

            return response()->json(['status' => 'OK', 'result' => ['confirmed' => $confirmed]]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy potwierdzeniu zaproszenia do znajomych.']);
        }
    }
}