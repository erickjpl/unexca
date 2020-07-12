<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Config\ImageResource;
use App\Http\Resources\Profile\ParentResource;
use App\Http\Resources\Profile\TeacherResource;
use App\Http\Resources\Profile\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Profile\UserDetailResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $verified = $this->resource->email_verified_at;
        return [
            'id' => (string) $this->resource->getRouteKey(),
            'type' => \App\Models\Profile\User::class,
            'attributes' => [
                'id' => $this->resource->id,
                'nickname' => $this->resource->nickname,
                'email' => $this->resource->email,
                'email_verified_at' => !!$verified ? $verified->format('Y-m-d') : null,
                'token' => $this->resource->token,
                'expires_in' => $this->resource->expires_in
            ],
            'relationships' => [
                'image' => [
                    ImageResource::make( $this->image )
                ],
                'detail' => [
                    UserDetailResource::make( $this->userDetail )
                ],
                'teacher' => [
                    TeacherResource::make( $this->teacher )
                ],
                'parent' => [
                    ParentResource::make( $this->parent )
                ],
                'student' => [
                    StudentResource::make( $this->student )
                ]
            ],
            'meta' => [
                'description' => 'Iniciar sesión'
            ]
        ];
    }
}
