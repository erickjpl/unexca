<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'type' => \App\Models\Profile\Teacher::class,
            'attributes' => [
                'id' => $this->resource->id,
                'speciality' => $this->resource->speciality,
                'status' => $this->resource->status,
            ]
        ];
    }
}
