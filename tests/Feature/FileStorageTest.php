<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

use Tests\TestCase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStorage()
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Ferdian Egha Kuncoro Ganteng Banget');
        $content = $filesystem->get('file.txt');
        self::assertEquals('Ferdian Egha Kuncoro Ganteng Banget', $content);
    }
    public function testPublic()
    {
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Ferdian Egha Kuncoro Ganteng Banget');
        $content = $filesystem->get('file.txt');
        self::assertEquals('Ferdian Egha Kuncoro Ganteng Banget', $content);
    }
}
