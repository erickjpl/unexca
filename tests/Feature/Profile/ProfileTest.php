<?php

namespace Tests\Feature\Profile;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function login($q)
    {
        $user = factory(\App\Models\Profile\User::class)->create();
        $image = $user->image()->save(factory(\App\Models\Config\Image::class)->make());
        $detail = $user->userDetail()->save(factory(\App\Models\Profile\UserDetail::class)->make());

        if ($q == 'teacher')
            $teacher = $user->teacher()->save(factory(\App\Models\Profile\Teacher::class)->make());
        if ($q == 'student')
            $student = $user->student()->save(factory(\App\Models\Profile\Teacher::class)->make());
        if ($q == 'parent')
            $parent = $user->parent()->save(factory(\App\Models\Profile\Teacher::class)->make());

        return $data = array(
            'user' => $user,
            'image' => $image,
            'detail' => $detail,
            'teacher' => $teacher ?? null,
            'student' => $student ?? null,
            'parent' => $parent ?? null,
        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEditProfileUser()
    {
        $this->withoutExceptionHandling();

        $user = $this->login('teacher')['user'];

        $login = $this->post('/api/auth/login', array('email' => $user->email, 'password' => 'password'));
        $token = $login->headers->get('authorization');

        if ( $login->assertStatus(200) ) 
        {
            $response = $this->put("/api/profile/user/{$user->id}", [
                'nickname' => 'testing',
                'email' => 'test@mail.com'
            ], ['HTTP_Authorization' => $token]);

            if ( $response->assertStatus(200) ) {
                $response->assertJson([
                    'data' => [
                        'id' => (string) $user->id,
                        'type' => \App\Models\Profile\User::class,
                        'attributes' => [
                            'id' => $user->id,
                            'nickname' => 'testing',
                            'email' => 'test@mail.com',
                            'email_verified_at' => $user->email_verified_at->format('Y-m-d'),
                        ],
                        'meta' => [
                            'description' => 'Detalles de la cuenta del usuario'
                        ]
                    ]
                ]);
            }
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEditProfileDetails()
    {
        $this->withoutExceptionHandling();

        $user = $this->login('teacher');
        $detail = $user['detail'];

        $login = $this->post('/api/auth/login', array('email' => $user['user']->email, 'password' => 'password'));
        $token = $login->headers->get('authorization');

        if ( $login->assertStatus(200) ) 
        {
            $response = $this->put("/api/profile/detail/{$user['user']->id}", [], ['HTTP_Authorization' => $token]);

            if ( $response->assertStatus(200) ) {
                $response->assertJson([
                    'data' => [
                        'id' => (string) $detail->id,
                        'type' => \App\Models\Profile\UserDetail::class,
                        'attributes' => [
                            'id'        => $detail->id,
                            'full_name' => $detail->full_name,
                            'name'      => $detail->name,
                            'lastname'  => $detail->lastname,
                            'dni'       => $detail->dni,
                            'phone'     => $detail->phone,
                            'birthdate' => $detail->birthdate->format('Y-m-d'),
                            'address'   => $detail->address,
                            'genre'     => $detail->genre,
                        ],
                        'meta' => [
                            'description' => 'Datos personales del usuario'
                        ]
                    ]
                ]);
            }
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEditProfilePassword()
    {
        $this->withoutExceptionHandling();

        $user = $this->login('teacher')['user'];

        $login = $this->post('/api/auth/login', array('email' => $user->email, 'password' => 'password'));
        $token = $login->headers->get('authorization');

        if ( $login->assertStatus(200) ) 
        {
            $response = $this->put("/api/profile/user/{$user->id}", [
                'password' => 'testing',
                'password_confirmation' => 'testing'
            ], ['HTTP_Authorization' => $token]);

            if ( $response->assertStatus(200) ) {
                $response->assertJson([
                    'data' => [
                        'id' => (string) $user->id,
                        'type' => \App\Models\Profile\User::class,
                        'attributes' => [
                            'id' => $user->id,
                            'nickname' => $user->nickname,
                            'email' => $user->email,
                            'email_verified_at' => $user->email_verified_at->format('Y-m-d'),
                        ],
                        'meta' => [
                            'description' => 'Detalles de la cuenta del usuario'
                        ]
                    ]
                ]);
            }
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        return $this->post('/api/auth/register', array(
            'nickname' => 'test',
            'email' => 'test@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVerificatedEmail()
    {
        $this->withoutExceptionHandling();

        $register = $this->testRegister('teacher');
        $token = $register->headers->get('authorization');

        $user = \App\Models\Profile\User::findOrFail(1);

        if ( $register->assertStatus(200) ) 
        {
            $response = $this->post("/api/profile/detail/{$user['user']->id}", [], ['HTTP_Authorization' => $token]);

            if ( $response->assertStatus(200) ) {
                $response->assertJson([
                    'data' => [
                        'id' => (string) $detail->id,
                        'type' => \App\Models\Profile\UserDetail::class,
                        'attributes' => [
                            'id'        => $detail->id,
                            'full_name' => $detail->full_name,
                            'name'      => $detail->name,
                            'lastname'  => $detail->lastname,
                            'dni'       => $detail->dni,
                            'phone'     => $detail->phone,
                            'birthdate' => $detail->birthdate->format('Y-m-d'),
                            'address'   => $detail->address,
                            'genre'     => $detail->genre,
                        ],
                        'meta' => [
                            'description' => 'Datos personales del usuario'
                        ]
                    ]
                ]);
            }
        }
    }
}
