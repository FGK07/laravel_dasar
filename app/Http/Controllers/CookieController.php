<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(Request $request)
    {
        return response("Hello Cookie")
            ->cookie("User-Id", "Kuncoro", 1000, "/")
            ->cookie("Is-Member", "true", 1000, "/");
    }

    public function getCookie(Request $request)
    {
        return response()
        ->json([
            "userId" => $request->cookie("User-Id", "guest"),
            "isMember" => $request->cookie("Is-Member", "false")
        ]);
    }
    
    public function clearCookie()
    {
        return response("Clear Cookie")
        ->withCookie("User-Id")
        ->withCookie("Is-Member");
    }
}
