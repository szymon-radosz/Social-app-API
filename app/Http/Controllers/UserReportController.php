<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserReport; 

class UserReportController extends Controller
{
    public function saveUserReport(Request $request){
        $topic = $request->topic;
        $message = $request->message;
        $user_id = $request->userId;

        $newUserReport = new UserReport();

        try{
            $newUserReport->topic = $topic;
            $newUserReport->message = $message;
            $newUserReport->user_id = $user_id;
    
            $newUserReport->save();

            return response()->json(['status' => 'OK', 'result' => $newUserReport]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisie zgłoszenia.']);
        }
    }
}
