<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginTeacher()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\Models\Profile\User::class)->create();
        $image = $user->image()->save(factory(\App\Models\Config\Image::class)->make());
        $teacher = $user->teacher()->save(factory(\App\Models\Profile\Teacher::class)->make());
        $detail = $user->userDetail()->save(factory(\App\Models\Profile\UserDetail::class)->make());

        $response = $this->post('/api/auth/login', array('email' => $user->email, 'password' => 'password'));
        $token = $response->headers->get('authorization');

        if ( $response->assertStatus(200) ) {
            $response->assertJson([
                'data' => [
                    'id' => (string) $user->id,
                    'type' => \App\Models\Profile\User::class,
                    'attributes' => [
                        'id' => $user->id,
                        'nickname' => $user->nickname,
                        'email' => $user->email,
                        'token' => $token
                    ],
                    'relationships' => [
                        'image' => [
                            array(
                                'id' => (string) $image->id,
                                'type' => \App\Models\Config\Image::class,
                                'attributes' => [
                                    'id'    => $image->id,
                                    'path'  => $image->path,
                                    'size'  => $image->size,
                                    'type'  => $image->type,
                                ]
                            )
                        ],
                        'detail' => [
                            array(
                                'id' => (string) $detail->id,
                                'type' => \App\Models\Profile\UserDetail::class,
                                'attributes' => [
                                    'id'        => $detail->id,
                                    'name'      => $detail->name,
                                    'lastname'  => $detail->lastname,
                                    'dni'       => $detail->dni,
                                    'phone'     => $detail->phone,
                                    'birthdate' => $detail->birthdate->format('Y-m-d'),
                                    'address'   => $detail->address,
                                    'genre'     => $detail->genre,
                                ]
                            )
                        ],
                        'teacher' => [
                            array(
                                'id' => (string) $teacher->id,
                                'type' => \App\Models\Profile\Teacher::class,
                                'attributes' => [
                                    'id'         => $teacher->id,
                                    'speciality' => $teacher->speciality,
                                    'status'     => $teacher->status,
                                ]
                            )
                        ],
                        'parent' => [null],
                        'student' => [null]
                    ],
                    'links' => [
                        'self' => 'http://localhost:8000/api/auth/login'
                    ],
                    'meta' => [
                        'description' => 'Iniciar sesión'
                    ]
                ]
            ]);
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginParent()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\Models\Profile\User::class)->create();
        $student = $user->student()->save(factory(\App\Models\Profile\Student::class)->make());

        $user = factory(\App\Models\Profile\User::class)->create();
        $image = $user->image()->save(factory(\App\Models\Config\Image::class)->make());
        $detail = $user->userDetail()->save(factory(\App\Models\Profile\UserDetail::class)->make());
        $parent = $user->parent()->save(factory(\App\Models\Profile\RelativeStudent::class)->make(['student_id' => $student->id]));

        $response = $this->postJson('/api/auth/login', array('email' => $user->email, 'password' => 'password'));
        $token = $response->headers->get('authorization');

        if ( $response->assertStatus(200) ) {
            $response->assertJson([
                'data' => [
                    'id' => (string) $user->id,
                    'type' => \App\Models\Profile\User::class,
                    'attributes' => [
                        'id' => $user->id,
                        'nickname' => $user->nickname,
                        'email' => $user->email,
                        'token' => $token
                    ],
                    'relationships' => [
                        'image' => [
                            array (
                                'id' => (string) $image->id,
                                'type' => \App\Models\Config\Image::class,
                                'attributes' => [
                                    'id'    => $image->id,
                                    'path'  => $image->path,
                                    'size'  => $image->size,
                                    'type'  => $image->type,
                                ]
                            )
                        ],
                        'detail' => [
                            array (
                                'id' => (string) $detail->id,
                                'type' => \App\Models\Profile\UserDetail::class,
                                'attributes' => [
                                    'id'        => $detail->id,
                                    'name'      => $detail->name,
                                    'lastname'  => $detail->lastname,
                                    'dni'       => $detail->dni,
                                    'phone'     => $detail->phone,
                                    'birthdate' => $detail->birthdate->format('Y-m-d'),
                                    'address'   => $detail->address,
                                    'genre'     => $detail->genre,
                                ]
                            )
                        ],
                        'teacher' => [null],
                        'parent' => [
                            array (
                                'id' => (string) $parent->id,
                                'type' => \App\Models\Profile\RelativeStudent::class,
                                'attributes' => [
                                    'id' => $parent->id,
                                    'family_relationship' => $parent->family_relationship
                                ]
                            )
                        ],
                        'student' => [null]
                    ],
                    'links' => [
                        'self' => 'http://localhost:8000/api/auth/login'
                    ],
                    'meta' => [
                        'description' => 'Iniciar sesión'
                    ]
                ]
            ]);
        }
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginStudent()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\Models\Profile\User::class)->create();
        $image = $user->image()->save(factory(\App\Models\Config\Image::class)->make());
        $student = $user->student()->save(factory(\App\Models\Profile\Student::class)->make());
        $detail = $user->userDetail()->save(factory(\App\Models\Profile\UserDetail::class)->make());

        $response = $this->post('/api/auth/login', array('email' => $user->email, 'password' => 'password'));
        $token = $response->headers->get('authorization');

        if ( $response->assertStatus(200) ) {
            $response->assertJson([
                'data' => [
                    'id' => (string) $user->id,
                    'type' => \App\Models\Profile\User::class,
                    'attributes' => [
                        'id' => $user->id,
                        'nickname' => $user->nickname,
                        'email' => $user->email,
                        'token' => $token
                    ],
                    'relationships' => [
                        'image' => [
                            array(
                                'id' => (string) $image->id,
                                'type' => \App\Models\Config\Image::class,
                                'attributes' => [
                                    'id'    => $image->id,
                                    'path'  => $image->path,
                                    'size'  => $image->size,
                                    'type'  => $image->type,
                                ]
                            )
                        ],
                        'detail' => [
                            array(
                                'id' => (string) $detail->id,
                                'type' => \App\Models\Profile\UserDetail::class,
                                'attributes' => [
                                    'id'        => $detail->id,
                                    'name'      => $detail->name,
                                    'lastname'  => $detail->lastname,
                                    'dni'       => $detail->dni,
                                    'phone'     => $detail->phone,
                                    'birthdate' => $detail->birthdate->format('Y-m-d'),
                                    'address'   => $detail->address,
                                    'genre'     => $detail->genre,
                                ]
                            )
                        ],
                        'teacher' => [null],
                        'parent' => [null],
                        'student' => [
                            array(
                                'id' => (string) $student->getRouteKey(),
                                'type' => \App\Models\Profile\Student::class,
                                'attributes' => [
                                    'id' => $student->id,
                                    'type' => $student->type,
                                    'status' => $student->status,
                                ]
                            )
                        ]
                    ],
                    'links' => [
                        'self' => 'http://localhost:8000/api/auth/login'
                    ],
                    'meta' => [
                        'description' => 'Iniciar sesión'
                    ]
                ]
            ]);
        }
    }
}
