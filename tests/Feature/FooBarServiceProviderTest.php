<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;

class FooBarServiceProviderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testServiceProvider(): void
    {
        // semuanya sama karena di registrasikan sebagai singleton
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo1, $bar1->foo);
        self::assertSame($foo2, $bar2->foo);

    }

    // registrasi singletons pakai property singletons binding
    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);
    }

    public function testProperty()
    {
        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Egha", $helloService->hello("Egha"));
    }

    public function testEmpty(){
        self::assertTrue(true);
    }
}
