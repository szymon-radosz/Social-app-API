<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\User;
use Illuminate\Http\Request;

class DashboardUsersController extends Controller
{
    use ErrorLogTrait;

    public function getUsers()
    {
        try {
            $users = User::latest()
                ->paginate(10);

            return response()->json(['status' => 'OK', 'result' => ['users' => $users]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-users-list', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get users']);
        }
    }

    public function getUsersByQuery(Request $request)
    {
        try {
            $query = $request->input('query');
            $users = User::where('nickname', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->paginate(10);

            return response()->json(['status' => 'OK', 'result' => ['users' => $users]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/get-users-by-query', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get users']);
        }
    }

    public function blockUser(Request $request)
    {
        try {
            $id = $request->input('id');

            $user = User::where('id', $id)->first();

            if ($user->blocked == 0) {
                $updatedUser = User::where('id', $id)
                    ->update(['blocked' => 1]);
            } else {
                $updatedUser = User::where('id', $id)
                    ->update(['blocked' => 0]);
            }

            return response()->json(['status' => 'OK', 'result' => ['user' => $updatedUser]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/block-user', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot get user']);
        }
    }

}
