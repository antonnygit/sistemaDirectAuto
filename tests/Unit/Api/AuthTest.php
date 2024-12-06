<?php

namespace Tests\Unit\Api;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_assert_login_with_dont_existing_user(): void
    {
        $data = [
            'email' => 'test@example',
            'password' => '12345678'
        ];

        $response = $this->postJson('/api/v1/login', $data);

        $response->assertStatus(401);
    }

    public function test_assert_login_with_existing_user(): void
    {
        $data = ['name' => 'testando',
            'email' => 'testando@testando',
            'password' => '12345678'  ];

        $user = User::create($data);

        $response = $this->postJson('api/v1/login', [
            'email' => $user->email,
            'password' =>$data['password']
        ]);

        $response->assertStatus(200);
    }
}
