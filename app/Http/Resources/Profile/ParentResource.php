<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
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
            'type' => \App\Models\Profile\RelativeStudent::class,
            'attributes' => [
                'id' => $this->resource->id,
                'family_relationship' => $this->resource->family_relationship
            ]
        ];
    }
}
