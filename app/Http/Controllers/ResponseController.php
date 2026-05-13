<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Contracts\Service\Attribute\Required;

class ResponseController extends Controller
{
    public function response(Request $request)
    {
        return response("hello response",);
    }

    public function header(Request $request)
    {
        $body = ["firstname"=> "Ferdian", "lastname" => "Kuncoro"];
        return response(json_encode($body), 200)
        ->header('Content-Type', 'application/json')
        ->withHeaders([
            'Author' => 'FGK07',
            'App' => 'Belajar Laravel'
        ]);
    }

    // response type
    public function responseView(Request $request)
    {
        return response()->view('hello', ['name' => 'Egha']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = ["firstname"=> "Ferdian", "lastname" => "Kuncoro"];
        return response()->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse{
        return response()->file(storage_path('app/public/pictures/Untitled.jpeg'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/pictures/Untitled.jpeg'), 'Untitled.jpeg');
    }
}
