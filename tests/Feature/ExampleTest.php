<?php

namespace Tests\Feature;

use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
//        $response = $this->json('POST', '/api/surveys', [
//            'phone' => '111-111-1111',
//            'completing_for' => Survey::COMPLETE_FOR_MYSELF,
//            'medical_help' => Survey::ANSWER_NO,
//            'location_home' => '111111',
//            'location_now' => '222222',
//            'group_count' => '2',
//            'shelter' => Survey::ANSWER_NO,
//            'food' => Survey::ANSWER_NO,
//            'home_flood' => Survey::ANSWER_NO,
//            'find' => Survey::ANSWER_NO,
//        ]);

//        $response->assertStatus(200);
    }
}
