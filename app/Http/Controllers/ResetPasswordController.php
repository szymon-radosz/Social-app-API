<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use App\User;
use App\Mail\ResetPassword;
use Validator;
use Mail;

class ResetPasswordController extends Controller
{
    public function sendPasswordResetToken(Request $request)
    {
        //var_dump($request->email);

        $user = User::where('email', $request->email)->first();
        if ( !$user ) return redirect()->home()->withErrors(['error' => '404']);

        try{
            //delete all old user password reset tokens
            DB::table('reset_password')->where('email', $user->email)->delete();

            //create a new token to be sent to the user. 
            DB::table('reset_password')->insert([
                'email' => $request->email,
                'token' => str_random(60), //change 60 to any length you want
                'created_at' => Carbon::now()
            ]);

            $tokenData = DB::table('reset_password')
                            ->where('email', $request->email)->first();

            $token = $tokenData->token;
            $email = $request->email; // or $email = $tokenData->email;

            /**
            * Send email to the email above with a link to your password reset
            * something like url('password-reset/' . $token)
            * Sending email varies according to your Laravel version. Very easy to implement
            */
            $sendResetPasswordEmail = new ResetPassword($token);
            Mail::to($email)->send($sendResetPasswordEmail);

            return response()->json(['status' => 'OK', 'result' => true]);
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => $e->getMessage()]); 
        }
    }

    /**
     * Assuming the URL looks like this 
     * http://localhost/password-reset/random-string-here
     * You check if the user and the token exist and display a page
     */

    public function showPasswordResetForm($token)
    {
        $tokenData = DB::table('reset_password')
        ->where('token', $token)->first();

        if ( !$tokenData ) return redirect()->to('home'); //redirect them anywhere you want if the token does not exist.
        return view('resetPassword.reset')->with(['token' => $token]);
    }

    protected function resetPasswordValidator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:6'],
            'passwordConfirmation' => ['required', 'string', 'min:6']
        ]);
    }

    public function resetPassword(Request $request, $token)
    {
        $password = $request->password;
        $passwordConfirmation = $request->passwordConfirmation;

        try{
            //some validation
            $this->resetPasswordValidator($request->all())->validate();
            
            if($password === $passwordConfirmation){
                $tokenData = DB::table('reset_password')
                                    ->where('token', $token)->first();

                $user = User::where('email', $tokenData->email)->first();
                if ( !$user ) return redirect()->to('home'); //or wherever you want

                $user->password = Hash::make($password);
                $user->update(); //or $user->save();

                //do we log the user directly or let them login and try their password for the first time ? if yes 
                //Auth::login($user);

                // If the user shouldn't reuse the token later, delete the token 
                DB::table('reset_password')->where('email', $user->email)->delete();
                return view('resetPassword.resetSuccess');

                //redirect where we want according to whether they are logged in or not.
            }else{
                return view('resetPassword.resetFail');                
            }
        }catch(\Exception $e){
            return view('resetPassword.resetFail');  
        }
    }
}
