<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHomePageText()
    {
        $response = $this->get('/');

        $response->assertSeeText('Hello world');
    }

    public function testContactPageText()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contacts Page');
    }
}
