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
                'email_verified_at' => null,
                'token' => $this->resource->token
            ],
            'meta' => [
                'description' => 'Registro de nuevos usuarios'
            ]
        ];
    }
}
