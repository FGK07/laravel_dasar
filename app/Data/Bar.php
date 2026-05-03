<?php

namespace App\Data;

class Bar{
    // bar depend ke foo, bar butuh foo untuk membuat object
    public Foo $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar():string{
        return $this->foo->foo() . " and Bar";
    }
}