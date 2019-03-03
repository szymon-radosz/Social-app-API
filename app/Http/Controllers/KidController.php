<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kid;
use App\User;
use Illuminate\Support\Facades\Auth; 
use DB;

class KidController extends Controller
{
    public function store(Request $request){
        try{
            $kid = new Kid();

            $user = DB::table('users')->where('email', $request->userEmail)->get(['id']);

            $kid->user_id = $user[0]->id;
            $kid->name = $request->name;
            $kid->date_of_birth = $request->dateOfBirth;
    
            $kid->save();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    
        $userData = User::find($user[0]->id)->with('kids')->with('hobbies')->get();

        return response()->json(['user' => $userData]); 

    }
}
