<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User; 
use App\Message;
use App\Notification;
use App\Hobby;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use DB;
use Carbon\Carbon;
use DateTime;

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
            try{
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('myapp')->accessToken; 
                $user->api_token = $success['token'];
                $user->save();
                return response()->json(['status' => 'OK', 'user' => $success]);
            }catch(\Exception $e){
                return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);
            }
        } 
        else{ 
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]);  
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
        try{
            $this->validator($request->all())->validate();

            event(new Registered($user = $this->create($request->all())));

            dispatch(new SendVerificationEmail($user));
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]); 
        }
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
        $user->email_verified_at = Carbon::now();

        if($user->save()){
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

            return response()->json(['user' => $user, 'status' => 'OK']);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy tworzeniu uzytkownika.']);
        }
    }
    /*
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details(Request $request) 
    { 
        try{
            $userData = User::where('id', Auth::user()->id)
                                                ->with('kids')
                                                ->with('hobbies')
                                                ->with('conversations')
                                                ->with('votes')
                                                ->with('notifications')
                                                ->firstOrFail();        

            $unreadedMessage = false;
            $unreadedMessageAmount = 0;
        
            $unreadedMessageAmount = Message::where([['receiver_id', Auth::user()->id], ['status', 0]])->count();

            if($unreadedMessageAmount > 0){
                $unreadedMessage = true;
            }

            $userData->setAttribute('unreadedConversationMessage', $unreadedMessage);
            $userData->setAttribute('unreadedConversationMessageAmount', $unreadedMessageAmount);

            $unreadedNotifications = false;
            $unreadedNotificationsAmount = 0;
        
            $unreadedNotificationsAmount = Notification::where([['user_id', Auth::user()->id], ['status', 0]])->count();

            if($unreadedNotificationsAmount > 0){
                $unreadedNotifications = true;
            }

            $userData->setAttribute('unreadedNotifications', $unreadedNotifications);
            $userData->setAttribute('unreadedNotificationsAmount', $unreadedNotificationsAmount);

            return response()->json(['status' => 'OK', 'result' => $userData]); 
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd przy autentykacji uytkownika.']); 
        }
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

            return response()->json(['status' => 'OK', 'result' => $user]); 
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]); 
        }
    }

    public function updateUserInfo(Request $request)
    {
        $userEmail = $request->userEmail;
        $age = $request->age;
        $desc = $request->desc;
        $lat = $request->lat;
        $lng = $request->lng;
        $locationString = $request->locationString ? $request->locationString : "";

        try{
            $updateUserInfo = User::where('email', $userEmail)
                                    ->update(
                                        ['age' => $age,
                                        'description' => $desc,
                                        'lattitude' => (double)$lat,
                                        'longitude' => (double)$lng,
                                        'location_string' => $locationString]
                                    );

            $user = User::where('email', $userEmail)
                            ->with('kids')
                            ->with('hobbies')
                            ->with('votes')
                            ->get();
 
            return response()->json(['status' => 'OK', 'result' => $user]); 
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]); 
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
                                    ->with('notifications')
                                    ->get();

            return response()->json(['status' => 'OK', 'result' => $user]);  
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd z zapisem danych potwierdzonego użytkownika.']); 
        }
    }

    public function loadUsersNearCoords(Request $request){
        $lat = $request->lat;
        $lng = $request->lng;

        $minLat = $lat - 2;
        $minLng = $lng - 2;

        $maxLat = $lat + 2;
        $maxLng = $lng + 2;

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

            return response()->json(['status' => 'OK', 'result' => $userList]);  
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem użytkowników z okolicy.']); 
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
                    [
                        'status' => 'OK', 
                        'result' => ['userUnreadedMessages' => $userUnreadedMessages,
                    'userUnreadedMessagesCount'  => $userUnreadedMessagesCount]
                    ]
                ); 
    }

    public function clearUserNotificationsStatus(Request $request){
        $userId = $request->userId;

        $userNotifications = Notification::where('user_id', $userId)
                                        ->update(['status' => 1]);

        return response()
                ->json(
                    [
                        'status' => 'OK', 
                        'result' => ['userNotifications' => $userNotifications]
                    ]
                ); 
    }

    public function loadUserByEmail(Request $request){
        $email = $request->email;

        try{
            $userList = User::
                    where('email', 'like', '%' . $email . '%')
                                                ->with('kids')
                                                ->with('hobbies')
                                                ->with('votes')
                                                ->get();

            return response()->json(['status' => 'OK', 'result' => $userList]);  
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem użytkowników według nazwy.']);  
        }
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

            return response()->json(['status' => 'OK', 'result' => $userList]);  
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem użytkowników według nazwy.']);  
        }
    }

    public function loadUsersFilter(Request $request){
        $distance = $request->distance ? $request->distance : "";
        $childAge = $request->childAge ? $request->childAge : "";
        $childGender = $request->childGender ? $request->childGender : "";
        $hobbyName = $request->hobbyName ? $request->hobbyName : "";
        $currentUserLat = $request->currentUserLat;
        $currentUserLng = $request->currentUserLng;

        $childGenderQueryValue;
        $childGenderDefault;
        $hobbyDefault;
        $hobbyId;

        //var_dump($distance);

        $calculateDistanceDifference = $this->calculateDistanceDifference($distance, $currentUserLat, $currentUserLng);
        $calculateChildAgeDifference = $this->calculateChildAgeDifference($childAge);

        if($childGender === "dziewczynka"){
            $childGenderQueryValue = "female";
            $childGenderDefault = false;
        }else if($childGender === "chłopiec"){
            $childGenderQueryValue = "male";
            $childGenderDefault = false;
        }else{
            $childGenderQueryValue = "";
            $childGenderDefault = true;
        }
        //var_dump([$calculateDistanceDifference, $calculateChildAgeDifference, $childGender]);

        // if user send some data then we return json with default => false
        // then in mobile app you can loop through all data from response
        // and if default => false for specific field, e.g. distance, childAge
        // then we setState with value from response and show active filters
        if($hobbyName){
            $hobbyRow = Hobby::where('name', $hobbyName)->first();
            $hobbyId = $hobbyRow->id;
            $hobbyDefault = false;
        }else{
            $hobbyDefault = true;
            $hobbyId = 0;
        }

        //var_dump($hobbyId);

        try{
            $userList = User::
                    where([
                        ['lattitude', '>', $calculateDistanceDifference->getData()->latDifferenceBottom], 
                        ['lattitude', '<', $calculateDistanceDifference->getData()->latDifferenceTop], 
                        ['longitude', '>', $calculateDistanceDifference->getData()->lngDifferenceBottom], 
                        ['longitude', '<', $calculateDistanceDifference->getData()->lngDifferenceTop]
                    ])
                    ->whereHas('kids', function ($query) use($calculateChildAgeDifference, $childGender, $childGenderQueryValue) {
                        if($childGender){
                            //var_dump([$calculateChildAgeDifference->getData()->formattedStartDate, $calculateChildAgeDifference->getData()->formattedEndDate, $childGender, $childGenderQueryValue]);
                            $query->where('date_of_birth', '>', $calculateChildAgeDifference->getData()->formattedStartDate)
                            ->where('date_of_birth', '<', $calculateChildAgeDifference->getData()->formattedEndDate)
                            ->where('child_gender', '=', $childGenderQueryValue);
                        }else{
                            $query->where('date_of_birth', '>', $calculateChildAgeDifference->getData()->formattedStartDate)
                            ->where('date_of_birth', '<', $calculateChildAgeDifference->getData()->formattedEndDate);
                        }
                    })
                    ->whereHas('hobbies', function ($query) use($hobbyId) {
                        //var_dump($hobbyId);
                        if($hobbyId != 0){
                            //var_dump([$calculateChildAgeDifference->getData()->formattedStartDate, $calculateChildAgeDifference->getData()->formattedEndDate, $childGender, $childGenderQueryValue]);
                            $query->where('hobby_id', '=', $hobbyId);
                        }
                    })
                    ->with('kids')
                    ->with('hobbies')
                    ->with('votes')
                    ->get();

            return response()->json(['status' => 'OK', 'result' => $userList, 'resultParameters' => [
                                                                                                        ['name' => 'distance', 'value' => $distance, 'default' => $calculateDistanceDifference->getData()->distanceDefault],
                                                                                                        ['name' => 'childAge', 'value' => $childAge, 'default' => $calculateChildAgeDifference->getData()->childAgeDefault],
                                                                                                        ['name' => 'childGender', 'value' => $childGender, 'default' => $childGenderDefault],
                                                                                                        ['name' => 'hobby', 'value' => $hobbyName, 'default' => $hobbyDefault]
                                                                                                    ]
                                    ]);  
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd ze zwróceniem użytkowników według dystansu.']);  
        }
    }

    public function calculateChildAgeDifference($childAge){
        //e.g. 1975-12-25
        $todayDate = Carbon::now()->toDateString();
        $timeStart = new DateTime($todayDate);
        $timeEnd = new DateTime($todayDate);
        $childAgeDefault;

        //var_dump($childAge);

        if($childAge === "0-6 miesięcy"){
            $formattedStartDate = $timeStart->modify('-6 months')->format('Y-m-d');
            $formattedEndDate = $timeEnd->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "7-12 miesięcy"){
            $formattedStartDate = $timeStart->modify('-1 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-6 months')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "1-2 lat"){
            $formattedStartDate = $timeStart->modify('-2 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-1 year')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "2-4 lat"){
            $formattedStartDate = $timeStart->modify('-4 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-2 year')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "4-8 lat"){
            $formattedStartDate = $timeStart->modify('-8 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-4 year')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "8-12 lat"){
            $formattedStartDate = $timeStart->modify('-12 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-8 year')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === "12-16 lat"){
            $formattedStartDate = $timeStart->modify('-16 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-12 year')->format('Y-m-d');
            $childAgeDefault = false;
        }else if($childAge === ""){
            $formattedStartDate = $timeStart->modify('-100 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->format('Y-m-d');
            $childAgeDefault = true;
        }

        return response()
                ->json(
                    [
                        'formattedStartDate' => $formattedStartDate,
                        'formattedEndDate' => $formattedEndDate,
                        'childAgeDefault' => $childAgeDefault
                    ]
                ); 
    }

    public function calculateDistanceDifference($distance, $currentUserLat, $currentUserLng){
        $coordsLatValue;
        $coordsLngValue;
        $distanceDefault;

        /*
        Degrees of latitude have the same linear distance anywhere in the world, because all lines of latitude are the same size. 
        So 1 degree of latitude is equal to 1/360th of the circumference of the Earth, which is 1/360th of 40,075 km.

        The length of a lines of longitude depends on the latitude. 
        The line of longitude at latitude l will be cos(l)*40,075 km. 
        One degree of longitude will be 1/360th of that.

        So you can work backwards from that. 
        Assuming you want something very close to one square kilometre, you'll want 1 * (360/40075) = 0.008983 degrees of latitude.

        At your example latitude of 53.38292839, the line of longitude will be cos(53.38292839)*40075 = [approx] 23903.297 km long. 
        So 1 km is 1 * (360/23903.297) = 0.015060 degrees.
        */

        if($distance === "1km"){
            $coordsLatValue = 1 * (360/40075);
            $coordsLngValue = 1 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "2km"){
            $coordsLatValue = 3 * (360/40075);
            $coordsLngValue = 3 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "5km"){
            $coordsLatValue = 5 * (360/40075);
            $coordsLngValue = 5 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "10km"){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "50km"){
            $coordsLatValue = 50 * (360/40075);
            $coordsLngValue = 50 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "100km"){
            $coordsLatValue = 100 * (360/40075);
            $coordsLngValue = 100 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === ""){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = true;
        }

        $latDifferenceBottom = $currentUserLat - $coordsLatValue;
        $lngDifferenceBottom = $currentUserLng - $coordsLngValue;

        $latDifferenceTop = $currentUserLat + $coordsLatValue;
        $lngDifferenceTop = $currentUserLng + $coordsLngValue;

        //var_dump([$latDifferenceBottom,$lngDifferenceBottom, $latDifferenceTop, $lngDifferenceTop ]);

        return response()
        ->json(
            [
                'latDifferenceBottom' => $latDifferenceBottom,
                'lngDifferenceBottom' => $lngDifferenceBottom,
                'latDifferenceTop' => $latDifferenceTop,
                'lngDifferenceTop' => $lngDifferenceTop,
                'distanceDefault' => $distanceDefault
            ]
        ); 
    }
}