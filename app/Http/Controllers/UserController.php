<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Http\Traits\CalculateDistanceDifferenceTrait;
use App\Http\Traits\ErrorLogTrait;
use App\Message;
use App\Notification;
use App\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class UserController extends Controller
{
    use ErrorLogTrait;
    use CalculateDistanceDifferenceTrait;

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['result' => 'invalid_credentials'], 401);
            } else {
                $user = User::where('email', $request->email)
                    ->first();
            }
        } catch (JWTException $e) {
            return response()->json(['result' => 'could_not_create_token'], 401);
        }

        return response()->json(['result' => [
            'token' => $token,
            'user_role' => $user->admin_role ? "admin" : "customer",
        ]], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => 'Invalid Data'], 401);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'nickname' => '',
            'platform' => $request->get['platform'] ? $request->get['platform'] : "",
            'age' => 0,
            'lattitude' => 0,
            'longitude' => 0,
            'description' => '',
            'admin_role' => $request->get('admin_role') ? $request->get('admin_role') : false,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['result' => compact('user', 'token')], 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['result' => 'user_not_found'], 401);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['result' => 'token_expired'], 401);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['result' => 'token_invalid'], 401);
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['result' => 'token_absent'], 401);
        }

        return response()->json(['result' => compact('user')], 201);
    }

    /*
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        try {
            $userData = User::where('id', Auth::user()->id)
                ->with('hobbies')
                ->with('conversations')
                ->with('votes')
                ->with('notifications')
                ->firstOrFail();

            $unreadedMessage = false;
            $unreadedMessageAmount = 0;

            $unreadedMessageAmount = Message::where([['receiver_id', Auth::user()->id], ['status', 0]])->count();

            if ($unreadedMessageAmount > 0) {
                $unreadedMessage = true;
            }

            $userData->setAttribute('unreadedConversationMessage', $unreadedMessage);
            $userData->setAttribute('unreadedConversationMessageAmount', $unreadedMessageAmount);

            $unreadedNotifications = false;
            $unreadedNotificationsAmount = 0;

            $unreadedNotificationsAmount = Notification::where([['user_id', Auth::user()->id], ['status', 0]])->count();

            if ($unreadedNotificationsAmount > 0) {
                $unreadedNotifications = true;
            }

            $storagePath = Storage::disk('userPhotos')->getDriver()->getAdapter()->getPathPrefix();

            $userData->setAttribute('unreadedNotifications', $unreadedNotifications);
            $userData->setAttribute('unreadedNotificationsAmount', $unreadedNotificationsAmount);
            $userData->setAttribute('storagePath', $storagePath);

            return response()->json(['result' => $userData, 201]);
        } catch (\Exception $e) {
            $this->storeErrorLog(Auth::user()->id, '/userDetails', $e->getMessage());

            return response()->json(['result' => 'Błąd przy autentykacji uytkownika.', 401]);
        }
    }

    public function checkIfEmailExists(Request $request)
    {
        try {
            $email = $request->email;

            $user = User::where('email', $email)->count();

            return response()->json(['result' => $user, 201]);
        } catch (\Exception $e) {
            $user = User::where('email', $email)->get();

            $this->storeErrorLog($user->id, '/checkIfEmailExists', $e->getMessage());

            return response()->json(['result' => $e->getMessage()], 401);
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $userEmail = $request->userEmail;
            $filename = 'userPhotos/' . time() . '-' . $request->fileName . ".jpg";

            $img = $request->file;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);

            Storage::disk('s3')->put($filename, base64_decode($img));
            Storage::disk('s3')->setVisibility($filename, 'public');

            $url = Storage::disk('s3')->url($filename);

            $this->storeErrorLog("", '/url', $url);

            $updateUserPhoto = DB::table('users')
                ->where('email', $userEmail)
                ->update(['photo_path' => $url]);

            $user = DB::table('users')
                ->where('email', $userEmail)->get();

            return response()->json(['result' => $user, 201]);
        } catch (\Exception $e) {
            $user = DB::table('users')
                ->where('email', $userEmail)->get();

            $this->storeErrorLog($user->id, '/updatePhoto', $e->getMessage());

            return response()->json(['result' => $e->getMessage()], 401);
        }
    }

    public function updateUserInfo(Request $request)
    {
        $userEmail = $request->userEmail;
        $nickname = $request->nickname;
        $age = $request->age;
        $desc = $request->desc;
        $lat = $request->lat;
        $lng = $request->lng;
        $locationString = $request->locationString ? $request->locationString : "";

        try {
            $updateUserInfo = User::where('email', $userEmail)
                ->update(
                    ['nickname' => $nickname,
                        'age' => $age,
                        'description' => $desc,
                        'lattitude' => (double) $lat,
                        'longitude' => (double) $lng,
                        'location_string' => $locationString]
                );

            $user = User::where('email', $userEmail)
                ->with('hobbies')
                ->with('votes')
                ->get();

            return response()->json(['result' => $user], 201);
        } catch (\Exception $e) {
            $user = User::where('email', $userEmail)->first();

            $this->storeErrorLog($user->id, '/updateUserInfo', $e->getMessage());

            return response()->json(['result' => $e->getMessage()], 401);
        }
    }

    public function checkAvailableNickname(Request $request)
    {
        $userEmail = $request->userEmail;
        $nickname = $request->nickname;

        try {
            $userByNickname = User::where([['nickname', $nickname], ['user_filled_info', 1]])->first();

            if ($userByNickname && $userByNickname->email === $userEmail) {
                return response()->json(['result' => true], 201);
            } else if ($userByNickname === null) {
                return response()->json(['result' => true], 201);
            } else {
                return response()->json(['result' => false], 201);
            }
        } catch (\Exception $e) {
            $user = User::where('email', $userEmail)->first();

            $this->storeErrorLog($user->id, '/checkAvailableNickname', $e->getMessage());

            return response()->json(['result' => 'Problem ze sprawdzeniem nazwy.'], 401);
        }
    }

    public function setUserFilledInfo(Request $request)
    {
        try {
            $userEmail = $request->userEmail;

            $updateUserInfo = DB::table('users')
                ->where('email', $userEmail)
                ->update(
                    ['user_filled_info' => 1]
                );

            $user = User::
                where('email', $userEmail)
                ->with('hobbies')
                ->with('votes')
                ->with('notifications')
                ->get();

            return response()->json(['result' => $user], 201);
        } catch (\Exception $e) {
            $user = User::where('email', $userEmail);

            $this->storeErrorLog($user->id, '/setUserFilledInfo', $e->getMessage());

            return response()->json(['result' => 'Błąd z zapisem danych potwierdzonego użytkownika.'], 401);
        }
    }

    public function loadUsersNearCoords(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $minLat = $lat - 2;
        $minLng = $lng - 2;

        $maxLat = $lat + 2;
        $maxLng = $lng + 2;

        try {
            $userList = User::
                where([
                ['lattitude', '<', $maxLat],
                ['longitude', '<', $maxLng],
                ['lattitude', '>', $minLat],
                ['longitude', '>', $minLng],
            ])
                ->with('hobbies')
                ->with('votes')
                ->get();

            return response()->json(['result' => $userList], 201);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/loadUsersNearCoords', $e->getMessage());

            return response()->json(['result' => 'Błąd ze zwróceniem użytkowników z okolicy.'], 401);
        }
    }

    public function setUserMessagesStatus(Request $request)
    {
        $userId = $request->userId;
        $conversationId = $request->conversationId;

        $userMessagesUpdate = Message::where([
            ['conversation_id', $conversationId],
            ['receiver_id', $userId],
        ])
            ->update(['status' => 1]);

        $userUnreadedMessagesCount = Message::where([
            ['receiver_id', $userId],
            ['status', 0],
        ])
            ->count();

        $userUnreadedMessages = false;

        if ($userUnreadedMessagesCount > 0) {
            $userUnreadedMessages = true;
        }

        return response()
            ->json(
                [
                    'result' => ['userUnreadedMessages' => $userUnreadedMessages,
                        'userUnreadedMessagesCount' => $userUnreadedMessagesCount],
                ], 201
            );
    }

    public function clearUserNotificationsStatus(Request $request)
    {
        $userId = $request->userId;

        $userNotifications = Notification::where('user_id', $userId)
            ->update(['status' => 1]);

        return response()
            ->json(
                [
                    'result' => ['userNotifications' => $userNotifications],
                ], 201
            );
    }

    public function loadUserByEmail(Request $request)
    {
        $email = $request->email;

        try {
            $userList = User::
                where('email', 'like', '%' . $email . '%')
                ->with('hobbies')
                ->with('votes')
                ->get();

            return response()->json(['result' => $userList], 201);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Błąd ze zwróceniem użytkowników według nazwy.'], 401);
        }
    }

    public function loadUserByName(Request $request)
    {
        $name = $request->name;

        try {
            $userList = User::
                where('name', 'like', '%' . $name . '%')
                ->with('hobbies')
                ->with('votes')
                ->get();

            return response()->json(['result' => $userList], 201);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Błąd ze zwróceniem użytkowników według nazwy.'], 401);
        }
    }

    public function loadUserDataById(Request $request)
    {
        $id = $request->id;

        try {
            $user = User::where('id', $id)
                ->get(["name", "email", "photo_path"]);

            return response()->json(['result' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['result' => 'Błąd ze zwróceniem użytkownika.'], 401);
        }
    }

    public function loadUsersFilter(Request $request)
    {
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

        //var_dump($calculateDistanceDifference, $calculateChildAgeDifference);

        if ($childGender === "dziewczynka") {
            $childGenderQueryValue = "female";
            $childGenderDefault = false;
        } else if ($childGender === "chłopiec") {
            $childGenderQueryValue = "male";
            $childGenderDefault = false;
        } else {
            $childGenderQueryValue = "";
            $childGenderDefault = true;
        }
        //var_dump([$calculateDistanceDifference, $calculateChildAgeDifference, $childGender]);

        // if user send some data then we return json with default => false
        // then in mobile app you can loop through all data from response
        // and if default => false for specific field, e.g. distance, childAge
        // then we setState with value from response and show active filters
        if ($hobbyName) {
            $hobbyRow = Hobby::where('name', $hobbyName)->first();
            $hobbyId = $hobbyRow->id;
            $hobbyDefault = false;
        } else {
            $hobbyDefault = true;
            $hobbyId = 0;
        }

        //var_dump($hobbyId);

        try {
            $userList = User::
                where([
                ['lattitude', '>', $calculateDistanceDifference->getData()->latDifferenceBottom],
                ['lattitude', '<', $calculateDistanceDifference->getData()->latDifferenceTop],
                ['longitude', '>', $calculateDistanceDifference->getData()->lngDifferenceBottom],
                ['longitude', '<', $calculateDistanceDifference->getData()->lngDifferenceTop],
            ])
                ->whereHas('hobbies', function ($query) use ($hobbyId) {
                    //var_dump($hobbyId);
                    if ($hobbyId != 0) {
                        //var_dump([$calculateChildAgeDifference->getData()->formattedStartDate, $calculateChildAgeDifference->getData()->formattedEndDate, $childGender, $childGenderQueryValue]);
                        $query->where('hobby_id', '=', $hobbyId);
                    }
                })
                ->with('hobbies')
                ->with('votes')
                ->get();

            return response()->json(['result' => $userList, 'resultParameters' => [
                ['name' => 'distance', 'value' => $distance, 'default' => $calculateDistanceDifference->getData()->distanceDefault],
                ['name' => 'childAge', 'value' => $childAge, 'default' => $calculateChildAgeDifference->getData()->childAgeDefault],
                ['name' => 'childGender', 'value' => $childGender, 'default' => $childGenderDefault],
                ['name' => 'hobby', 'value' => $hobbyName, 'default' => $hobbyDefault],
            ], 201,
            ]);
        } catch (\Exception $e) {
            $this->storeErrorLog(0, '/loadUsersFilter', $e->getMessage());

            return response()->json(['result' => 'Błąd ze zwróceniem użytkowników według dystansu.'], 401);
        }
    }

    public function calculateChildAgeDifference($childAge)
    {
        //e.g. 1975-12-25
        $todayDate = Carbon::now()->toDateString();
        $timeStart = new DateTime($todayDate);
        $timeEnd = new DateTime($todayDate);
        $childAgeDefault;

        //var_dump($childAge);

        if ($childAge === "0-6 miesięcy") {
            $formattedStartDate = $timeStart->modify('-6 months')->format('Y-m-d');
            $formattedEndDate = $timeEnd->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "7-12 miesięcy") {
            $formattedStartDate = $timeStart->modify('-1 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-6 months')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "1-2 lat") {
            $formattedStartDate = $timeStart->modify('-2 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-1 year')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "2-4 lat") {
            $formattedStartDate = $timeStart->modify('-4 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-2 year')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "4-8 lat") {
            $formattedStartDate = $timeStart->modify('-8 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-4 year')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "8-12 lat") {
            $formattedStartDate = $timeStart->modify('-12 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-8 year')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "12-16 lat") {
            $formattedStartDate = $timeStart->modify('-16 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->modify('-12 year')->format('Y-m-d');
            $childAgeDefault = false;
        } else if ($childAge === "") {
            $formattedStartDate = $timeStart->modify('-100 year')->format('Y-m-d');
            $formattedEndDate = $timeEnd->format('Y-m-d');
            $childAgeDefault = true;
        }

        return response()
            ->json(
                [
                    'formattedStartDate' => $formattedStartDate,
                    'formattedEndDate' => $formattedEndDate,
                    'childAgeDefault' => $childAgeDefault,
                ], 201
            );
    }
}
