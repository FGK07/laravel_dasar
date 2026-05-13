<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertStatus(200)
            ->assertSeeText('Hello Cookie')
            ->assertCookie('User-Id', 'Kuncoro')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie("User-Id", "Kuncoro")
            ->withCookie("Is-Member", "true")
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'Kuncoro',
                'isMember' => 'true',
            ]);
    }
}
