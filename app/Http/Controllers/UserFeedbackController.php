<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserFeedback; 

class UserFeedbackController extends Controller
{
    public function saveUserFeedback(Request $request){
        $topic = $request->topic;
        $message = $request->message;
        $user_id = $request->userId;

        $newUserFeedback = new UserFeedback();

        try{
            $newUserFeedback->topic = $topic;
            $newUserFeedback->message = $message;
            $newUserFeedback->user_id = $user_id;
    
            $newUserFeedback->save();

            return response()->json(['status' => 'OK', 'result' => $newUserFeedback]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie zgłoszenia.']);
        }
    }
}