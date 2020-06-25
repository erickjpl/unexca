<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'type' => \App\Models\Profile\Student::class,
            'attributes' => [
                'id' => $this->resource->id,
                'type' => $this->resource->type,
                'status' => $this->resource->status,
            ]
        ];
    }
}
