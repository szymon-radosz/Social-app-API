<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;
use App\User;
use Illuminate\Support\Facades\Auth; 
use DB;

class HobbyController extends Controller
{
    public function index(){
        try{
            $hobbies = Hobby::all();

            return response()->json(['status' => 'OK', 'result' => $hobbies]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zwróceniu listy hobby.']);
        }
        
    }
    public function store(Request $request){
        try{
            $user = DB::table('users')->where('email', $request->userEmail)->get();
            
            $findUser = User::find($user[0]->id);
            
            $findUser->hobbies()->attach($request->hobby_id);
            
            $userData = User::find($user[0]->id)->with('kids')->with('hobbies')->get();

            return response()->json(['status' => 'OK', 'result' => $userData]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisywaniu hobby.']);
        }
    }
}
