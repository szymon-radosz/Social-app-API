<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;
use App\User;
use Illuminate\Support\Facades\Auth; 
use DB;

class HobbyController extends Controller
{
    public function store(Request $request){
        try{
            $hobby = new Hobby();

            $user = DB::table('users')->where('email', $request->user_email)->get();

            $findUser = User::find($user[0]->id);

            $findUser->hobbies()->attach($request->hobby_id);

            /*$hobby->user_id = $user[0]->id;
            $hobby->hobby_id = $request->hobby_id;
    
            $hobby->save();*/
        }catch(\Exception $e){
            return $e->getMessage();
        }
    
        $userData = User::find($user[0]->id)->with('kids')->with('hobbies')->get();

        return response()->json(['user' => $userData]); 

    }
}
