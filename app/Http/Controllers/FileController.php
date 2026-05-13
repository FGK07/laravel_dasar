<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // buat uploaded filenya
        $picture = $request->file('picture');
        //tentukan pathnya yaitu pictures, ambil nama uploaded filenya, dan simpan di public
        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public");

        return "OK " . $picture->getClientOriginalName();
    }
}
