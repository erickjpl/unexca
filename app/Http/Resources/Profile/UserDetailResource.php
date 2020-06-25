<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            'type' => \App\Models\Profile\UserDetail::class,
            'attributes' => [
                'id' => $this->resource->id,
                'name' => $this->resource->name,
                'lastname' => $this->resource->lastname,
                'dni' => $this->resource->dni,
                'phone' => $this->resource->phone,
                'birthdate' => $this->resource->birthdate->format('Y-m-d'),
                'address' => $this->resource->address,
                'genre' => $this->resource->genre,
            ]
        ];
    }
}
