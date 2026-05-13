<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testURLCurrent()
    {
        $this->get('/url/current?name=egha')
        ->assertSeeText('/url/current?name=egha');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
        ->assertSeeText('/redirect/name/egha');
    }

    public function testAction()
    {
        $this->get('/url/action')
        ->assertSeeText('/form');
    }
}
