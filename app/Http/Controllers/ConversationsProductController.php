<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use App\User;
use App\Message;
use DB;
use Illuminate\Support\Collection;
use App\Http\Traits\ErrorLogTrait;

class ConversationsProductController extends Controller
{
    use ErrorLogTrait;

    public function checkIfUsersAreInProductConversation($senderId, $receiverId, $productId){
        $senderConversations = DB::table('conversation_user')->where('user_id', $senderId)->get();

        $usersAreInTheSameConversation = false;

        foreach($senderConversations as $singleSenderConversation){
            $convationIdMatched = DB::table('conversation_user')->where(
                                                        [
                                                            ['conversation_id', $singleSenderConversation->conversation_id],
                                                            ['user_id', $receiverId]
                                                        ])->get();

            //check when count() > 0 every conversation and when that product_id is productId parameter in some case, then users are in the same product conversation
            foreach($convationIdMatched as $singleFoundConversation){
                $conversationNotProductIdData = Conversation::where([
                                                            ['id', $singleFoundConversation->conversation_id],
                                                            ['product_id', '=', $productId]
                                                        ])->count();
                if($conversationNotProductIdData > 0){
                    $usersAreInTheSameConversation = true;
                }
            }
        }
        
        //var_dump($usersAreInTheSameConversation);
        //return bool
        return $usersAreInTheSameConversation;
    }

    public function checkIfUsersBelongsToProductConversation(Request $request){
        $loggedInUser = $request->loggedInUser;
        $searchedUser = $request->searchedUser;
        $productId = $request->productId;

        $checkIfUsersAreInProductConversation = $this->checkIfUsersAreInProductConversation($loggedInUser, $searchedUser, $productId);

        return response()->json(['status' => 'OK', 'result' => $checkIfUsersAreInProductConversation]);
    }

    public function store(Request $request){
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;
        $productId = $request->productId;
        $message = $request->message;

        $usersAreInTheSameConversation = $this->checkIfUsersAreInProductConversation($senderId, $receiverId, $productId);

        //var_dump($productId);

        if($usersAreInTheSameConversation === false){
            try{
                $conversation = new Conversation();
                $conversation->product_id = $productId;
                $conversation->save();
            }catch(\Exception $e){
                return response()->json(['status' => 'ERR', 'result' => 'Błąd przy tworzeniu konwersacji.']);
            }
    
            if($conversation->id){
                try{
                    $findSender = User::find($senderId);
                    $createdConversation = Conversation::find($conversation->id);
                    $createdConversation->users()->attach($findSender->id);
    
                    $findReceiver = User::find($receiverId);
                    $createdConversation = Conversation::find($conversation->id);
                    $createdConversation->users()->attach($findReceiver->id);
    
                    $newMessage = new Message();
                    $newMessage->conversation_id = $conversation->id;
                    $newMessage->sender_id = $senderId;
                    $newMessage->receiver_id = $receiverId;
                    $newMessage->message = $message;
                    $newMessage->status = 0;
            
                    $newMessage->save();
                }catch(\Exception $e){
                    return response()->json(['status' => 'ERR', 'result' => 'Błąd przy tworzeniu nowej wiadomości w konwersacji.']);
                }
            }
        
            return response()->json(['status' => 'OK', 'result' => $conversation]);
        }
        $this->storeErrorLog($request->senderId, '/saveConversationProduct', $e->getMessage());

        return response()->json(['status' => 'ERR', 'result' => 'Użytkownicy są już ze sobą w konwersacji.']);
    }
}