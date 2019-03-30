<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConversationProduct;
use App\User;
use App\MessageProduct;
use DB;
use Illuminate\Support\Collection;

class ConversationsProductController extends Controller
{
    public function store(Request $request){
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $product_id = $request->product_id;
        $message = $request->message;

        $senderConversations = DB::table('conversation_product_user')->where('user_id', $sender_id)->get();

        $usersAreInTheSameConversation = false;

        foreach($senderConversations as $singleLoggedInUserConversation){
            $checkIfConvationIdMatched = DB::table('conversation_product_user')->where(
                                                        [
                                                            ['conversation_product_id', $singleLoggedInUserConversation->conversation_product_id],
                                                            ['product_id', $product_id],
                                                            ['user_id', $receiver_id]
                                                        ])->count();

            if($checkIfConvationIdMatched > 0){
                $usersAreInTheSameConversation = true;
            }
        }

        if($usersAreInTheSameConversation === false){
            try{
                $conversation = new ConversationProduct();
                $conversation->save();
            }catch(\Exception $e){
                return $e->getMessage();
            }
    
            if($conversation->id){
                try{
                    $findSender = User::find($sender_id);
                    $createdConversation = ConversationProduct::find($conversation->id);
                    $createdConversation->users()->attach($findSender->id, array('product_id' => $product_id));
    
                    $findReceiver = User::find($receiver_id);
                    $createdConversation = ConversationProduct::find($conversation->id);
                    $createdConversation->users()->attach($findReceiver->id, array('product_id' => $product_id));
    
                    $newMessage = new MessageProduct();
                    $newMessage->conversation_product_id = $conversation->id;
                    $newMessage->sender_id = $sender_id;
                    $newMessage->receiver_id = $receiver_id;
                    $newMessage->message = $message;
                    $newMessage->status = 0;
            
                    $newMessage->save();
                }catch(\Exception $e){
                    return $e->getMessage();
                }
            }
        
            return response()->json(['conversationProduct' => $conversation]); 
        }
        return response()->json(['error' => 'Użytkownicy są już ze sobą w konwersacji przy produkcie']); 
    }

    public function showUserConversationsProduct(Request $request){
        $user_id = $request->user_id;

        //var_dump($user_id);

        $userData = User::where('id', $user_id)->with('conversationsProduct')->first();

        //var_dump($userData);
        $conversationData = new Collection();

        //loop through all user conversation where user take part
        foreach($userData->conversations as $singleConversation){

            //var_dump($singleConversation->id);

            //get all messages for specific conversation
            $conversationMessages = ConversationProduct::where('id', $singleConversation->id)->with('messages')->get();

            //for each message in conversation check if current user
            //first sent a message or he/she was receiver
            foreach($conversationMessages as $singleMessage){

                //check the last message in conversation, if receiver_id == user_id
                //and status == 0 it means user didnt read that and you have to bold that

                $userHadUnreadedMessages = false;
                //var_dump($singleMessage->messages->count());
                $lastMessageIndex = $singleMessage->messages->count() - 1;

                if($singleMessage->messages[$lastMessageIndex]->receiver_id == $user_id && $singleMessage->messages[$lastMessageIndex]->status === 0){
                    $userHadUnreadedMessages = true;
                }
               
                //user was not the conversation author
                if($singleMessage->messages[0]->receiver_id != $user_id){
                    $receiverInfo = User::where('id', $singleMessage->messages[0]->receiver_id)->get(['id', 'name', 'email', 'photo_path']);
                }
                //user was conversation author
                else{
                    $receiverInfo = User::where('id', $singleMessage->messages[0]->sender_id)->get(['id', 'name', 'email', 'photo_path']);
                }

                //get info about user when you open conversation with that user
                $receiverId = $receiverInfo[0]->id;
                $receiverName = $receiverInfo[0]->name;
                $receiverEmail = $receiverInfo[0]->email;
                $receiverPhotoPath = $receiverInfo[0]->photo_path;

                $singleMessage->setAttribute('receiverId', $receiverId);
                $singleMessage->setAttribute('receiverName', $receiverName);
                $singleMessage->setAttribute('receiverEmail', $receiverEmail);
                $singleMessage->setAttribute('receiverPhotoPath', $receiverPhotoPath);
                $singleMessage->setAttribute('userHadUnreadedMessages', $userHadUnreadedMessages);
                
            }

            $conversationData->push($conversationMessages);
        }
        return response()->json(['userData' => $userData->conversations, 'conversationProductsData' => $conversationData]);  
    }

    public function showConversationProductDetails(Request $request){
        $conversation_id = $request->conversation_id;

        //$userData = User::where('id', $user_id)->with('conversations')->get();
        $conversation = ConversationProduct::where('id', $conversation_id)->with('messages')->get();

        //$conversationData = array();

        //var_dump($userData[0]->conversations);

        /*foreach($userData[0]->conversations as $singleConversation){
            $conversationMessages = Conversation::where('id', $singleConversation->id)->with('messages')->get();

            foreach($conversationMessages as $singleMessage){
                //var_dump($singleMessage->messages[0]->receiver_id);
                $receiverInfo = User::where('id', $singleMessage->messages[0]->receiver_id)->get(['name', 'email', 'photo_path']);

                $receiverName = $receiverInfo[0]->name;
                $receiverEmail = $receiverInfo[0]->email;
                $receiverPhotoPath = $receiverInfo[0]->photo_path;

                $singleMessage->setAttribute('receiverName', $receiverName);
                $singleMessage->setAttribute('receiverEmail', $receiverEmail);
                $singleMessage->setAttribute('receiverPhotoPath', $receiverPhotoPath);
            }
        }*/

        return response()->json(['conversationData' => $conversation]);
    }

    public function checkIfUsersBelongsToConversationProduct(Request $request){
        $loggedInUser = $request->loggedInUser;
        $searchedUser = $request->searchedUser;

        $loggedInUserConversations = DB::table('conversation_product_user')->where('user_id', $loggedInUser)->get();

        $usersAreInTheSameConversation = false;

        foreach($loggedInUserConversations as $singleLoggedInUserConversation){
            $checkIfConvationIdMatched = DB::table('conversation_product_user')->where(
                                                        [
                                                            ['conversation_product_id', $singleLoggedInUserConversation->conversation_id],
                                                            ['user_id', $searchedUser]
                                                        ])->count();

            if($checkIfConvationIdMatched > 0){
                $usersAreInTheSameConversation = true;
            }
        }

        return response()->json(['usersAreInTheSameConversation' => $usersAreInTheSameConversation]);
    }
}
