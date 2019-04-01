<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use App\User;
use App\Message;
use DB;
use Illuminate\Support\Collection;

class ConversationsProductController extends Controller
{
    public function store(Request $request){
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $product_id = $request->product_id;
        $message = $request->message;

        $senderConversations = DB::table('conversation_user')->where('user_id', $sender_id)->get();

        $usersAreInTheSameConversation = false;

        foreach($senderConversations as $singleLoggedInUserConversation){
            $IfConvationIdMatched = DB::table('conversation_user')->where(
                                                        [
                                                            ['conversation_id', $singleLoggedInUserConversation->conversation_id],
                                                            ['user_id', $receiver_id]
                                                        ])->first();

            if($IfConvationIdMatched){

                //var_dump($checkIfConvationIdMatched->conversation_id);

                $isConversationWithProductId = Conversation::where('id', $IfConvationIdMatched->conversation_id)->first();
                

                if($isConversationWithProductId->product_id == $product_id){
                    $usersAreInTheSameConversation = true;
                }

                //var_dump($usersAreInTheSameConversation);
                
            }
        }

        if($usersAreInTheSameConversation === false){
            try{
                $conversation = new Conversation();
                $conversation->product_id = $product_id;
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
        return response()->json(['error' => 'Użytkownicy są już ze sobą w konwersacji']);
    }

}