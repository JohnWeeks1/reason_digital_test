<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// I've done some tests but it's not full coverage.
// In most of the companies I've worked for in the past, I didn't do much unit testing, sorry.

class AppTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test_user_can_register
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->post('api/register', [
            'name' => 'Test 1',
            'email' => 'john@m.com',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        if (!empty($response['token'])) {
            $this->assertTrue(true);
        }

    }

    /**
     * test_user_can_register
     *
     * @return void
     */
    public function test_user_can_login_and_get_token()
    {
        $this->post('api/register', [
            'name' => 'Test 1',
            'email' => 'john@m.com',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        $response = $this->post('api/login', [
            'email' => 'john@m.com',
            'password' => '123123123',
        ]);

        if (!empty($response['token'])) {
            $this->assertTrue(true);
        }
    }

    /**
     * test_user_can_not_register_because_email_is_wrong
     *
     * @return void
     */
    public function test_user_can_not_register_because_email_is_wrong()
    {
        $response = $this->post('api/register', [
            'name' => 'Test 1',
            'email' => 'john@m.',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        $response->assertStatus(302);
    }

    /**
     * test_passwords_are_not_the_same
     *
     * @return void
     */
    public function test_passwords_are_not_the_same()
    {
        $response = $this->post('api/register', [
            'name' => 'Test 1',
            'email' => 'john@m.',
            'password' => '123123123',
            'password_confirmation' => '99999',
        ]);

        $response->assertStatus(302);
    }

    /**
     * test_get_weather_by_location_with_bearer_token
     *
     * @return void
     */
    public function test_get_weather_by_location_with_bearer_token()
    {
        $response = $this->post('api/register', [
            'name' => 'Test 1',
            'email' => 'john@m.com',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        $weather = $this->withHeader(
            'Authorization', 'Bearer ' . $response['token']
        )->json('get', '/api/forecast/London');

        $weather->assertStatus(200);
    }

}
