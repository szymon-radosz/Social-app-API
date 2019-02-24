<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kid;

class KidController extends Controller
{
    public function store(Request $request){
        try{
            $kid = new Kid();

            $kid->user_id = $request->user_id;
            $kid->name = $request->name;
            $kid->date_of_birth = $request->date_of_birth;
    
            $kid->save();
        }catch(\Exception $e){
            return Redirect::back()->withErrors(['msg', $e->getMessage()]);
        }
    
        return Redirect::back()->withErrors(['msg', 'Saved kid']);

    }
}
