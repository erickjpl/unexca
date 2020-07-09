<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'email_verified_at' => $this->resource->email_verified_at->format('Y-m-d')
            ],
            'meta' => [
                'description' => 'Detalles de la cuenta del usuario'
            ]
        ];
    }
}
