<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testGet(){
        $this->get('/gha')
        ->assertStatus(200)
        ->assertSeeText('Kuncoro Ganteng');
    }

    public function testRedirect(){
        $this->get('/github')
        ->assertRedirect('/gha');
    }

    public function testFallback(){
        $this->get('/tidak ada')
        ->assertSeeText('404 by Kuncoro Ganteng');
        
        $this->get('/tidak mungkin')
        ->assertSeeText('404 by Kuncoro Ganteng');
        
        $this->get('/tidak pernah')
        ->assertSeeText('404 by Kuncoro Ganteng');
    }

    public function testRouteParameter(){
        $this->get('/products/1')
        ->assertSeeText('Product 1');
        $this->get('/products/2');

        $this->get('/products/2')
        ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
        ->assertSeeText('Product 1, Item XXX');

        $this->get('/products/2/items/XXX')
        ->assertSeeText('Product 2, Item XXX');
    }
    public function testRouteParameterRegex(){
        $this->get('/categories/12')
        ->assertSeeText('Category : 12');
        $this->get('/categories/egha')
        ->assertSeeText('404 by Kuncoro Ganteng');
    }

    public function testRouteParameterOptional(){
        $this->get('/users/egha')
        ->assertSeeText('User egha');
        $this->get('/users')
        ->assertSeeText('User 404');
    }

    public function testRouteConflict(){
        $this->get('/conflict/budi')
        ->assertSeeText('Conflict budi');

        $this->get('/conflict/kuncoro')
        ->assertSeeText('Conflict Ferdian Egha Kuncoro');
    }

    public function testNamedRoute(){
        $this->get('/produk/12345')
        ->assertSeeText('Link http://localhost/products/12345');
        
        $this->get('/produk-redirect/12345')
        ->assertRedirect('/products/12345');
    }
}
