<?php



namespace XR\LU\Tests\Feature;

use Tests\TestCase;

class LUFeatureTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
