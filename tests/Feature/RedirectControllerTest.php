<?php

namespace Tests\Feature;

use App\Http\Controllers\RedirectController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testReditrect()
    {
        $this->get('/redirect/from')
        ->assertRedirect('/redirect/to');
    }

    public function testRedirectName()
    {
        $this->get('/redirect/name')
        ->assertRedirect('/redirect/name/Kuncoro');
    }

    public function testRedirectAction()
    {
        $this->get('/redirect/action')
        ->assertRedirect('/redirect/name/Kuncoro');
    }
    
    public function testRedirectAway()
    {
        $this->get('/redirect/away')
        ->assertRedirect('https://github.com/FGK07/laravel_dasar');
    }

}
