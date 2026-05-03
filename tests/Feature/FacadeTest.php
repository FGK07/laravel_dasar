<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;


use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testConfig(){
        $config = $this->app->make("config");
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');
        self::assertEquals($firstName1, $firstName2);
        var_dump(Config::all());

    }
    public function testConfigDepenmdency(){
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');
        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);
        var_dump($config->all());

    }

}
