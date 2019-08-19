<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserFeedback; 
use App\User;
use App\Http\Traits\ErrorLogTrait;
use Mail;
use App\Mail\Feedback;

class UserFeedbackController extends Controller
{
    use ErrorLogTrait;

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

            $userEmail = User::where('id', $user_id)->first();

            $SendVerificationEmail = new Feedback($userEmail->email, $topic, $message);
            Mail::to("kontakt@e-mamy.pl")->send($SendVerificationEmail);

            return response()->json(['status' => 'OK', 'result' => $newUserFeedback]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/saveUserFeedback', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie zgłoszenia.']);
        }
    }
}