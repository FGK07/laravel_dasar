<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUpload()
    {
        $picture = UploadedFile::fake()->image('kuncoro.png');
        $this->post('/file/upload',[
            'picture' => $picture,
        ])->assertSeeText("OK kuncoro.png");
    }
}
