<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HelloService;

class HelloController extends Controller
{
    private HelloService $helloService;

    /**
     *service container otomatis melakukan dependency injection
     *saat sebuah contructor di controller membutuhkan dependency 
     *class lain
     */

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(Request $request, string $name): string{
        //$request->path();//ambil path
        //$request->url();//ambil url tanpa query parameter
        //$request->fullUrl();//ambil url dengan query parameter
        return $this->helloService->hello($name);
    }

    public function request(Request $request):string
    {
        return $request->path().PHP_EOL.
            $request->url().PHP_EOL.
            $request->fullUrl().PHP_EOL.
            $request->method().PHP_EOL.
            $request->header('Accept').PHP_EOL;
    }
}
