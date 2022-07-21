<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    
    public function test_addingNotificationShouldFailIfTheEmailIsEmpty()
    {
        $response = $this->post('/notifications/add', ['email' => '', 'price' => 222]);
        $response->assertJson(['status' => 0, 'message' => 'Invalid Email']);
        $response->assertStatus(200);
    }
    
    public function test_addingNotificationShouldFailIfTheEmailIsInvalid()
    {
        $response = $this->post('/notifications/add', ['email' => 'fake_email', 'price' => 222]);
        $response->assertJson(['status' => 0, 'message' => 'Invalid Email']);
        $response->assertStatus(200);
    }
    
    
    public function test_addingNotificationShouldFailIfThePriceIsEmpty()
    {
        $response = $this->post('/notifications/add', ['email' => 'test@tes.com', 'price' => '']);
        $response->assertJson(['status' => 0, 'message' => 'Invalid Price']);
        $response->assertStatus(200);
    }
    
    public function test_addingNotificationShouldSuccseedIfInputDataIsCorrect()
    {
        $response = $this->post('/notifications/add', ['email' => 'test@test.com', 'price' => 123]);
        $response->assertJson(['status' => 1]);
        $response->assertStatus(200);
    }
}
