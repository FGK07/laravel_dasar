<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testView(){
        $this->get('/hello')
        ->assertSeeText('Hello Ferdian');
        $this->get('/hello-again')
        ->assertSeeText('Hello Kuncoro');
    }

    public function testViewNested(){
        $this->get('/hello-world')
        ->assertSeeText('Kuncoro');
        $this->get('/hello-world-again')
        ->assertSeeText('Egha');
    }

    // test tanpa route
    public function testTemplate(){
        
        $this->view('hello', ['name' => 'Egha'])
        ->assertSeeText('Hello Egha');

        $this->view('hello.world', ['name' => 'Kuncoro'])
        ->assertSeeText('World Kuncoro');


    }
}
