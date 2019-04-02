<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User; 
use App\Message;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use DB;

class UserController extends Controller 
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('myapp')->accessToken; 
            $user->api_token = $success['token'];
            $user->save();
            return response()->json(['user' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }
    /**
    * Handle a registration request for the application.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        dispatch(new SendVerificationEmail($user));

        //return view('verification');
        return $user;
    }

    /**
    * Handle a registration request for the application.
    *
    * @param $token
    * @return \Illuminate\Http\Response
    */
    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();

        $user->verified = 1;

        if($user->save()){
            /*return response()->json([
                'user' => $user
            ]);*/

            return view('emailconfirm');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'age' => 0,
                'lattitude' => 0,
                'longitude' => 0,
                'description' => '',
                'email_token' => base64_encode($data['email'])
            ]);

            $success['token'] =  $user->createToken('myapp')->accessToken; 
            $success['name'] =  $user->name;

            return response()->json([
                'user' => $user
            ]);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    /*
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details(Request $request) 
    { 

        $userData = User::where('id', Auth::user()->id)
                                            ->with('kids')
                                            ->with('hobbies')
                                            ->with('conversations')
                                            ->with('votes')
                                            ->firstOrFail();        

        $unreadedMessage = false;
        $unreadedMessageAmount = 0;
       
        $unreadedMessageAmount = Message::where([['receiver_id', Auth::user()->id], ['status', 0]])->count();

        if($unreadedMessageAmount > 0){
            $unreadedMessage = true;
        }

        $userData->setAttribute('unreadedConversationMessage', $unreadedMessage);
        $userData->setAttribute('unreadedConversationMessageAmount', $unreadedMessageAmount);

        return response()->json(['user' => $userData], $this->successStatus); 
    } 

    public function updatePhoto(Request $request)
    {
        try{
            $path = $request->file;
            $userEmail = $request->userEmail;
            $filename = time() . '-' . $request->fileName . ".jpg";
            
            \Image::make($path)->save(public_path('userPhotos/' . $filename));

            $updateUserPhoto = DB::table('users')
                    ->where('email', $userEmail)
                    ->update(['photo_path' => $filename]);

            $user = DB::table('users')
                    ->where('email', $userEmail)->get();

            return response()->json(['user' => $user]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateUserInfo(Request $request)
    {
        try{
            $userEmail = $request->userEmail;
            $age = $request->age;
            $desc = $request->desc;
            $lat = $request->lat;
            $lng = $request->lng;

            $updateUserInfo = DB::table('users')
                    ->where('email', $userEmail)
                    ->update(
                        ['age' => $age,
                        'description' => $desc,
                        'lattitude' => (double)$lat,
                        'longitude' => (double)$lng]
                    );

            $user = DB::table('users')::
                                where('email', $userEmail)
                                ->with('kids')
                                ->with('hobbies')
                                ->with('votes')
                                ->get();

            return response()->json(['user' => $user]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function setUserFilledInfo(Request $request){
        try{
            $userEmail = $request->userEmail;

            $updateUserInfo = DB::table('users')
                    ->where('email', $userEmail)
                    ->update(
                        ['user_filled_info' => 1]
                    );

            $user = User::
                    where('email', $userEmail)
                                    ->with('kids')
                                    ->with('hobbies')
                                    ->with('votes')
                                    ->get();

            return response()->json(['user' => $user]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function loadUsersNearCoords(Request $request){
        $lat = $request->lat;
        $lng = $request->lng;

        $minLat = $lat - 1;
        $minLng = $lng - 1;

        $maxLat = $lat + 1;
        $maxLng = $lng + 1;

        try{
            $userList = User::
                    where([
                        ['lattitude', '<', $maxLat], 
                        ['longitude', '<', $maxLng],
                        ['lattitude', '>', $minLat], 
                        ['longitude', '>', $minLng]
                    ])
                    ->with('kids')
                    ->with('hobbies')
                    ->with('votes')
                    ->get();

            return response()->json(['userList' => $userList]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    
    public function setUserMessagesStatus(Request $request){
        $userId = $request->userId;
        $conversationId = $request->conversationId;

        $userMessagesUpdate = Message::where([
                                        ['conversation_id', $conversationId],
                                        ['receiver_id', $userId]
                                        ])
                                        ->update(['status' => 1]);

        $userUnreadedMessagesCount = Message::where([
                                            ['receiver_id', $userId],
                                            ['status', 0]
                                        ])
                                        ->count();

        $userUnreadedMessages = false;

        if($userUnreadedMessagesCount > 0){
            $userUnreadedMessages = true;
        }

        return response()
                ->json(
                    ['userUnreadedMessages' => $userUnreadedMessages,
                    'userUnreadedMessagesCount'  => $userUnreadedMessagesCount]
                ); 
    }

    public function loadUserByName(Request $request){
        $name = $request->name;

        try{
            $userList = User::
                    where('name', 'like', '%' . $name . '%')
                                                ->with('kids')
                                                ->with('hobbies')
                                                ->with('votes')
                                                ->get();

            return response()->json(['userList' => $userList]); 
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}