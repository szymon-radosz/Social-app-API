<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request){
        $newMessage = new Message();

        try{
            $newMessage->conversation_id = $request->conversation_id;
            $newMessage->sender_id = $request->sender_id;
            $newMessage->receiver_id = $request->receiver_id;
            $newMessage->message = $request->message;
            $newMessage->status = $request->status;
    
            $newMessage->save();
    
            return response()->json(['status' => 'OK', 'result' => $newMessage]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy wysyłaniu wiadomości.']);
        }
        
    }
}
