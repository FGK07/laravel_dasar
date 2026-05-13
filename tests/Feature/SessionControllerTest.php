<?php

namespace Tests\Feature;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateSession()
    {
        $this->get('/session/create')
        ->assertSeeText("OK")
        ->assertSessionHas("userId", "egha")
        ->assertSessionHas("isMember", true);
    }

    public function testGetSession()
    {
        $this->withSession([
            "userId" => "egha",
            "isMember" => "true"
        ])->get('/session/get')
        ->assertSeeText("User Id : egha , Is Member : true");
    }



}
