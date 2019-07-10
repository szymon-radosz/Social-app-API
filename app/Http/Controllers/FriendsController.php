<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\Http\Traits\ErrorLogTrait;

class FriendsController extends Controller
{
    use ErrorLogTrait;

    public function friendsList(Request $request){
        $userId = $request->userId;

        try{
            $friendsList = Friend::where([['sender_id', $userId], ['confirmed', 1]])
                                ->orWhere([['receiver_id', $userId], ['confirmed', 1]])
                                ->with('usersInvitedMe')
                                ->with('usersInvitedByMe')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => ['friendsList' => $friendsList]]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/friendsList', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }

    public function pendingFriendsList(Request $request){
        $userId = $request->userId;

        try{
            $friendsList = Friend::where([['sender_id', $userId], ['confirmed', 0]])
                                ->orWhere([['receiver_id', $userId], ['confirmed', 0]])
                                ->with('usersInvitedMe')
                                ->with('usersInvitedByMe')
                                ->get();

            return response()->json(['status' => 'OK', 'result' => ['friendsList' => $friendsList]]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/pendingFriendsList', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }

    public function countFriends(Request $request){
        $userId = $request->userId;

        try{
            $countFriends = Friend::where([['sender_id', $userId], ['confirmed', 1]])
                                ->orWhere([['receiver_id', $userId], ['confirmed', 1]])
                                ->count();

            return response()->json(['status' => 'OK', 'result' => ['countFriends' => $countFriends]]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/countFriends', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróćeniu ilości znajomych.']);
        }
    }

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
            $this->storeErrorLog($request->senderId, '/checkFriend', $e->getMessage());

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
            $this->storeErrorLog($request->senderId, '/inviteFriend', $e->getMessage());

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
            $this->storeErrorLog($request->senderId, '/confirmFriend', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy potwierdzeniu zaproszenia do znajomych.']);
        }
    }
}
