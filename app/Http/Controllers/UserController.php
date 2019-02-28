<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;

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
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
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
            return response()->json([
                'user' => $user
            ]);
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

            $success['token'] =  $user->createToken('MyApp')->accessToken; 
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
    public function details() 
    { 
        //$user = Auth::user(); 

        $userData = User::find(Auth::id())->with('kids')->with('hobbies')->get();

        return response()->json(['user' => $userData], $this->successStatus); 
    } 
}