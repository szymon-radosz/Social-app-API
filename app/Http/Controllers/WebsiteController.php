<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function terms(Request $request)
    {
        return view('terms');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
