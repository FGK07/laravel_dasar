<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\TextUI\Application;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testResponse(): void
    {
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText('hello response');
    }

    public function testHeader(){
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('Ferdian')
        ->assertSeeText('Kuncoro')
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'FGK07')
        ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView(){
        $this->get('/response/type/view')
        ->assertSeeText('Hello Egha');
    }

    public function testJson(){
        $this->get('/response/type/json')
        ->assertJson(['firstname' => 'Ferdian', 'lastname' => 'Kuncoro']);
    }

    public function testFile(){
        $this->get('/response/type/file')
        ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload(){
        $this->get('/response/type/download')
        ->assertDownload('Untitled.jpeg');
    }
}
