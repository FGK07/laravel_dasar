<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testInput(): void
    {
        $this->get('/input/hello?name=Kuncoro')->assertSeeText('Hello Kuncoro');
        $this->post('/input/hello', [
            'name' => 'Kuncoro',
        ])->assertSeeText('Hello Kuncoro');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Egha',
            ],
        ])->assertSeeText('Hello Egha');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Egha',
                'last' => 'Kuncoro',
            ],
        ])
            ->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('Egha')
            ->assertSeeText('last')
            ->assertSeeText('Kuncoro');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => 30000000,
                ],
                [
                    'name' => 'Samsung Galaxy S10',
                    'price' => 15000000,
                ],
            ],
        ])
            ->assertSeeText('Apple Mac Book Pro')
            ->assertSeeText('Samsung Galaxy S10');
    }

    public function testInputControllerParam()
    {
        $this->post('/input/controller', [
            'name' => 'Kuncoro',
        ])->assertSeeText('Hello Kuncoro');
    }

    public function testInputTest()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birth_date' => '1990-10-10',
        ])
            ->assertSeeText('Budi')
            ->assertSeeText('true')
            ->assertSeeText('1990-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only/', [
            'name' => [
                'first' => 'ferdian',
                'middle' => 'egha',
                'last' => 'kuncoro',
            ],
        ])
            ->assertSeeText('ferdian')
            ->assertSeeText('kuncoro')
            ->assertDontSeeText('egha');
    }
    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username' => 'ferdian',
            'password' => 'rahasia123',
            'admin' => 'true',
        ])
            ->assertSeeText('ferdian')
            ->assertSeeText('rahasia123')
            ->assertDontSeeText('admin');
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'username' => 'ferdian',
            'password' => 'rahasia123',
            'admin' => 'true',
        ])
            ->assertSeeText('ferdian')
            ->assertSeeText('rahasia123')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }

    
}
