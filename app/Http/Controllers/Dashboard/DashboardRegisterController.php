<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorLogTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardRegisterController extends Controller
{
    use ErrorLogTrait;

    public function addUser(Request $request)
    {
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->admin_role = 1;
            $user->email_toke = base64_encode($email);
            $user->save();

            return response()->json(['status' => 'OK', 'result' => ['user' => $user]]);
        } catch (\Exception $e) {
            $this->storeErrorLog("dashboard", '/add-user', $e->getMessage());

            return response()->json(['status' => 'ERR', 'result' => 'Cannot save user']);
        }
    }
}
