<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        // dynamic property
        // $name = $request->name;
        return "Hello $name";
    }

    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function helloInput(Request $request)
    {
        $input = $request->input();

        return json_encode($input);
    }

    public function helloArray(Request $request)
    {
        $names = $request->input('products.*.name');
        return json_encode($names);
    }

    public function inputControllerParam(string $name)
    {
        return "Hello $name";
    }

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('Y-m-d'),
        ]);
    }

    // filter request input
    public function filterOnly(Request $request)
    {
        // hanya menerima input yang ada di only
        $name = $request->only('name.first', 'name.last');
        return json_encode($name);
    }

    public function filterExcept(Request $request)
    {
        // tidak menerima input yang ada di except
        $user = $request->except('admin');
        return json_encode($user);
    }

    public function filterMerge(Request $request)
    {
        //tidak peduli ada apa tidak admin akan di set ke false
        $request->merge([
            "admin" => false,
        ]);
        $user = $request->input();
        return json_encode($user);
    }
}
