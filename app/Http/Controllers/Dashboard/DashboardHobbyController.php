<?php

namespace App\Http\Controllers\Dashboard;

use App\Hobby;
use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\Translation;
use Illuminate\Http\Request;

class DashboardHobbyController extends Controller
{
    use ErrorLogTrait;

    public function index()
    {
        try {
            $hobbies = Hobby::get();

            return response()->json(['status' => 'OK', 'result' => ['hobbies' => $hobbies]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-hobbies', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get hobbies']);
        }
    }

    public function blockHobby(Request $request)
    {
        try {
            $id = $request->input('id');

            $hobby = Hobby::where('id', $id)->first();

            if ($hobby->blocked == 0) {
                $updatedHobby = Hobby::where('id', $id)
                    ->update(['blocked' => 1]);
            } else {
                $updatedHobby = Hobby::where('id', $id)
                    ->update(['blocked' => 0]);
            }

            return response()->json(['status' => 'OK', 'result' => ['hobby' => $updatedHobby]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/block-hobby', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get updatedHobby']);
        }
    }

    public function store(Request $request)
    {
        try {
            $name = $request->input('name');

            $hobby = new Hobby();
            $hobby->name = $name;
            $hobby->save();

            $translation = new Translation();
            $translation->name = $name;
            $translation->en = $name;
            $translation->blocked = 1;
            $translation->save();

            return response()->json(['status' => 'OK', 'result' => ['hobby' => $hobby]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/add-hobby', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot save hobby']);
        }
    }
}
