<?php

namespace App\Http\Traits;
use App\ErrorLog;

trait ErrorLogTrait {
    public function storeErrorLog($user_id, $requestName, $message) {
        $user_id = $user_id;
        $requestName = $requestName;
        $message = $message;

        try{
            $errorLog = new ErrorLog();

            $errorLog->user_id = $user_id;
            $errorLog->request = $requestName;
            $errorLog->message = $message;

            $errorLog->save();

            return $errorLog;
        }catch(\Exception $e){
            return response()->json(['status' => 'ERR', 'result' => 'Błąd z zapisem błędu do bazy']);
        }
    }
}