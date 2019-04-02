<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;

class VotesController extends Controller
{
    public function store(Request $request){
        $vote = new Vote();

        $vote->user_id = $request->user_id;
        $vote->vote = $request->vote;
        $vote->message = $request->message;
        $vote->author_id = $request->author_id;

        try{
            $userVotedForAnotherUser = Vote::where([['user_id', $request->user_id], ['author_id', $request->author_id]])->count();

            //user vote for user_id in the past
            if($userVotedForAnotherUser > 0){
                return response()->json(['error' => 'Głos z Twojego konta był juz oddany']); 
            }else{
                $vote->save();

                return response()->json(['vote' => $vote]); 
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
