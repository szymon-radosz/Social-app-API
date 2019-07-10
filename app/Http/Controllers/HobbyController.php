<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;
use App\User;
use Illuminate\Support\Facades\Auth; 
use DB;
use App\Http\Traits\ErrorLogTrait;

class HobbyController extends Controller
{
    use ErrorLogTrait;

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
            $user = DB::table('users')->where('email', $request->userEmail)->get();

            $this->storeErrorLog($user[0]->id, '/saveHobby', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy zapisywaniu hobby.']);
        }
    }

    public function cleanUserHobbies(Request $request){
        $userId = $request->userId;
        
        try{
            $deletedHobbyUser = DB::table('hobby_user')
                                            ->where('user_id', $userId)
                                            ->delete();

            return response()->json(['status' => 'OK', 'result' => $deletedHobbyUser]);
        }catch(\Exception $e){
            $this->storeErrorLog($request->userId, '/cleanUserHobbies', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Błąd usunięciu relacji hobby-user']);
        }
    }

   
}
