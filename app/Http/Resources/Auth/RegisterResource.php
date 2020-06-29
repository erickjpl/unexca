<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->resource->getRouteKey(),
            'type' => \App\Models\Profile\User::class,
            'attributes' => [
                'id' => $this->resource->id,
                'nickname' => $this->resource->nickname,
                'email' => $this->resource->email,
                'token' => $this->resource->token
            ],
            'links' => [
                'self' => route('register')
            ],
            'meta' => [
                'description' => 'Registro de usuario'
            ]
        ];
    }
}
