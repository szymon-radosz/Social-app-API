<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use App\User;
use App\Message;

class ConversationsController extends Controller
{
    public function store(Request $request){
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $message = $request->message;
        
        try{
            $conversation = new Conversation();
            $conversation->save();
        }catch(\Exception $e){
            return $e->getMessage();
        }

        if($conversation->id){
            try{
                $findSender = User::find($sender_id);
                $createdConversation = Conversation::find($conversation->id);
                $createdConversation->users()->attach($findSender->id);

                $findReceiver = User::find($receiver_id);
                $createdConversation = Conversation::find($conversation->id);
                $createdConversation->users()->attach($findReceiver->id);

                $newMessage = new Message();
                $newMessage->conversation_id = $conversation->id;
                $newMessage->sender_id = $sender_id;
                $newMessage->receiver_id = $receiver_id;
                $newMessage->message = $message;
                $newMessage->status = 0;
        
                $newMessage->save();
            }catch(\Exception $e){
                return $e->getMessage();
            }
        }
    
        return response()->json(['conversation' => $conversation]); 
    }
}
