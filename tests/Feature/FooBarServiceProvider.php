<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;

class FooBarServiceProvider extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);
        
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($bar1, $bar2);
    }
}
