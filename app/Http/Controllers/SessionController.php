<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request)
    {
        $request->session()->put("userId", "egha");
        $request->session()->put("isMember", true);
        return "OK"; 
    }

    public function getSession(Request $request)
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', "true");

        return "User Id : " . $userId . " , Is Member : " . $isMember; 
    }
}