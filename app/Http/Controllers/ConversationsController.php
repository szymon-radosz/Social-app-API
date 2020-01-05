<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Http\Traits\ErrorLogTrait;
use App\Message;
use App\Product;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ConversationsController extends Controller
{
    use ErrorLogTrait;

    public function checkIfUsersAreInNormalConversation($senderId, $receiverId)
    {
        $senderConversations = DB::table('conversation_user')->where('user_id', $senderId)->get();

        $usersAreInTheSameConversation = false;

        foreach ($senderConversations as $singleSenderConversation) {
            $convationIdMatched = DB::table('conversation_user')->where(
                [
                    ['conversation_id', $singleSenderConversation->conversation_id],
                    ['user_id', $receiverId],
                ])->get();

            //check when count() > 0 every conversation and when that product_id is 0 in some case, then users are in the same normal conversation
            foreach ($convationIdMatched as $singleFoundConversation) {
                $conversationNotProductIdData = Conversation::where([
                    ['id', $singleFoundConversation->conversation_id],
                    ['product_id', '=', 0],
                ])->count();
                if ($conversationNotProductIdData > 0) {
                    $usersAreInTheSameConversation = true;
                }
            }
        }

        //var_dump($usersAreInTheSameConversation);
        //return bool
        return $usersAreInTheSameConversation;
    }

    public function store(Request $request)
    {
        $senderId = $request->senderId;
        $receiverId = $request->receiverId;
        $message = $request->message;

        $usersAreInTheSameConversation = $this->checkIfUsersAreInNormalConversation($senderId, $receiverId);

        if ($usersAreInTheSameConversation === false) {
            try {
                $conversation = new Conversation();
                $conversation->save();
            } catch (\Exception $e) {
                return response()->json(['status' => 'ERR', 'result' => 'Błąd przy tworzeniu konwersacji.']);
            }

            if ($conversation->id) {
                try {
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
                } catch (\Exception $e) {
                    $this->storeErrorLog($senderId, '/saveConversation1', $e->getMessage());

                    return response()->json(['status' => 'ERR', 'result' => 'Błąd przy tworzeniu konwersacji.']);
                }
            }
            return response()->json(['status' => 'OK', 'result' => $conversation]);
        }
        $this->storeErrorLog($request->senderId, '/saveConversation2', $e->getMessage());

        return response()->json(['status' => 'ERR', 'result' => 'Użytkownicy są już ze sobą w konwersacji.']);
    }

    public function showUserConversations(Request $request)
    {
        $user_id = $request->user_id;

        try {
            if ($request->has('showProductsConversations')) {
                $userData = User::where('id', $user_id)
                    ->with(['conversations' => function ($query) {
                        $query->where('product_id', '!=', 0);
                    }])->first();
            } else {
                $userData = User::where('id', $user_id)
                    ->with(['conversations' => function ($query) {
                        $query->where('product_id', '==', 0);
                    }])->first();
            }

            $conversationData = new Collection();

            //loop through all user conversation where user take part
            foreach ($userData->conversations as $singleConversation) {

                //var_dump($singleConversation->product_id);

                //get all messages for specific conversation
                if ($request->has('showProductsConversations')) {
                    $conversationMessages = Conversation::where([['id', $singleConversation->id], ['product_id', '!=', 0]])->with('messages')->get();
                } else {
                    $conversationMessages = Conversation::where([['id', $singleConversation->id], ['product_id', 0]])->with('messages')->get();
                }

                //var_dump($singleMessage->product_id);

                //for each message in conversation check if current user
                //first sent a message or he/she was receiver
                foreach ($conversationMessages as $singleMessage) {

                    //var_dump($singleMessage->product_id);

                    //check the last message in conversation, if receiver_id == user_id
                    //and status == 0 it means user didnt read that and you have to bold that

                    $userHadUnreadedMessages = false;
                    //var_dump($singleMessage->messages->count());
                    $lastMessageIndex = $singleMessage->messages->count() - 1;

                    if ($singleMessage->messages[$lastMessageIndex]->receiver_id == $user_id && $singleMessage->messages[$lastMessageIndex]->status === 0) {
                        $userHadUnreadedMessages = true;
                    }

                    //user was not the conversation author
                    if ($singleMessage->messages[0]->receiver_id != $user_id) {
                        $receiverInfo = User::where('id', $singleMessage->messages[0]->receiver_id)->get(['id', 'name', 'email', 'photo_path']);
                    }
                    //user was conversation author
                    else {
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
            return response()->json(['status' => 'OK', 'result' => ['userData' => $userData->conversations, 'conversationData' => $conversationData]]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu konwersacji użytkownika.']);
        }
    }

    public function showConversationDetails(Request $request)
    {
        $conversation_id = $request->conversation_id;

        try {
            $conversation = Conversation::where('id', $conversation_id)
                ->with('messages')
                ->first();

            if ($conversation->product_id) {
                $product = Product::where('id', $conversation->product_id)->first();

                return response()->json(['status' => 'OK', 'result' => ['conversation' => $conversation, 'productOwnerId' => $product->user_id]]);
            } else {
                return response()->json(['status' => 'OK', 'result' => ['conversation' => $conversation, 'productOwnerId' => 0]]);
            }

        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/showConversationDetails', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu konwersacji użytkownika.']);
        }
    }

    public function checkIfUsersBelongsToConversation(Request $request)
    {
        $loggedInUser = $request->loggedInUser;
        $searchedUser = $request->searchedUser;

        $checkIfUsersAreInNormalConversation = $this->checkIfUsersAreInNormalConversation($loggedInUser, $searchedUser);

        return response()->json(['status' => 'OK', 'result' => $checkIfUsersAreInNormalConversation]);
    }

    public function loadUserById(Request $request)
    {
        $userId = $request->userId;
        $loggedInUser = $request->loggedInUser;

        try {
            $user = User::where("id", $userId)
                ->with('hobbies')
                ->with('votes')
                ->firstOrFail();

            $checkIfUsersAreInNormalConversation = $this->checkIfUsersAreInNormalConversation($loggedInUser, $userId);

            return response()->json(['status' => 'OK', 'result' => ['user' => $user, 'checkIfUsersAreInNormalConversation' => $checkIfUsersAreInNormalConversation]]);
        } catch (\Exception $e) {
            $this->storeErrorLog($request->userId, '/loadUserById', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
        }
    }
}
