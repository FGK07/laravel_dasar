<?php

namespace Tests\Feature;
use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testDependency(): void
    {
        // field app dibuat otomatis oleh laravel
        $foo1 = $this->app->make(Foo::class); // sama saja dengan new Foo()
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind(){
        // $person = $this->app->make(Person::class);  = new person() error karena butuh parameter yang perlu di isi di constructor
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app){
            return new Person("Egha", "Kuncoro");
        }); // akan dipanggil ketika kita manggil make

        $person1 = $this->app->make(Person::class); // memanggil closure() new Person("Egha", "Kuncoro");
        $person2 = $this->app->make(Person::class); // closure() new Person("Egha", "Kuncoro");

        self::assertEquals('Egha', $person1->firstName);
        self::assertEquals('Egha', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton(){
        // $person = $this->app->make(Person::class);  = new person()
        // self::assertNotNull($person);
        // singleton adalah objectnya sekali aja dibuat kalau butuh dependency cukup kembalikan object yang sama tidak perlu dibuat baru

        $this->app->singleton(Person::class, function ($app){
            return new Person("Egha", "Kuncoro");
        });

        $person1 = $this->app->make(Person::class); // new Person("Egha", "Kuncoro"); if not exists
        $person2 = $this->app->make(Person::class);// return existing
        $person3 = $this->app->make(Person::class);// return existing
        $person4 = $this->app->make(Person::class);// return existing

        self::assertEquals('Egha', $person1->firstName);
        self::assertEquals('Egha', $person2->firstName); 
        self::assertSame($person1, $person2);
    }
    
    public function testInstance()
    {
        // $person = $this->app->make(Person::class);  = new person()
        // self::assertNotNull($person); error
        $person = new Person("Egha", "Kuncoro");
        $this->app->instance(Person::class, $person);// langsung masukkan object yang sudah ada

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class);// $person
        $person3 = $this->app->make(Person::class);// $person
        $person4 = $this->app->make(Person::class);// $person

        self::assertEquals('Egha', $person1->firstName);
        self::assertEquals('Egha', $person2->firstName); 
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        // Ketika buat object baru langsung di injectkan, kalau belum ada buat baru kecuali pakai singleton

        $this->app->singleton(Foo::class, function($app){// ini merupakan service container bagian yang function
            return new Foo();
        });

        // dependency injection closure
        $this->app->singleton(Bar::class, function($app){// parameter app sebagai service container
            $foo = $app->make(Foo::class); // buat class foo
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);// object bar butuh FOO di constructor akan ambil yang di singleton
        $bar2 = $this->app->make(Bar::class);// object bar butuh FOO di constructor akan ambil yang di singleton

        self::assertSame($foo, $bar1->foo);// objectnya menjadi sama
        self::assertSame($bar1, $bar2);
    }
    
    public function testHelloService()
    {
        // bukan pakai closure
        //$this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // pakai closure
        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
            
        });

        $helloService = $this->app->make(HelloService::class); // mengembalikan object dari class implementasinya
        self::assertEquals("Halo Egha", $helloService->hello("Egha"));
        
    }
}
