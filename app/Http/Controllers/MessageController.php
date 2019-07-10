<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Traits\ErrorLogTrait;

class MessageController extends Controller
{
    use ErrorLogTrait;

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
            $this->storeErrorLog($request->sender_id, '/saveMessage', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy wysyłaniu wiadomości.']);
        }
        
    }
}
