<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicRegistration()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/auth/register', array(
            'nickname' => 'test',
            'email' => 'test@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ));

        $token = $response->headers->get('authorization');

        $user = \App\Models\Profile\User::findOrFail(1);

        if ( $response->assertStatus(201) ) {
            $response->assertJson([
                'data' => [
                    'id' => (string) $user->id,
                    'type' => \App\Models\Profile\User::class,
                    'attributes' => [
                        'id' => $user->id,
                        'nickname' => $user->nickname,
                        'email' => $user->email,
                        'email_verified_at' => null,
                        'token' => $token
                    ],
                    'meta' => [
                        'description' => 'Registro de nuevos usuarios'
                    ]
                ]
            ]);
        }
    }
}
