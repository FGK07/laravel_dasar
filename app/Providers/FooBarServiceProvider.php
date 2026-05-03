<?php

namespace App\Providers;
use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // kasus sederhana pakai property singleton untuk binding
    public array $singletons = [
        HelloService::class=>HelloServiceIndonesia::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        // echo "FooBarServiceProvider";
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    // dipanggil ketika dibutuhkan saja jika tidak dibutuhkan maka tidak akan dipanggil
    public function provides()
    {
        return[HelloService::class, Foo::class, Bar::class];
    }
}
