<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Http\Traits\ErrorLogTrait;

class VotesController extends Controller
{
    use ErrorLogTrait;

    public function store(Request $request){
        $vote = new Vote();

        $vote->user_id = $request->userId;
        $vote->vote = $request->vote;
        $vote->message = $request->message;
        $vote->author_id = $request->authorId;

        try{
            $userVotedForAnotherUser = Vote::where([['user_id', $request->userId], ['author_id', $request->authorId]])->count();

            //user vote for user_id in the past
            if($userVotedForAnotherUser > 0){
                return response()->json(['status' => 'ERR', 'result' => 'Głos z Twojego konta był juz oddany.']); 
            }else{
                $vote->save();

                return response()->json(['status' => 'OK', 'result' => $vote]); 
            }
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/saveVote', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Problem z dodaniem głosu.']); 
        }
    }
}
