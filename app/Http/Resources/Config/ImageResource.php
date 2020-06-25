<?php

namespace App\Http\Resources\Config;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'type' => \App\Models\Config\Image::class,
            'attributes' => [
                'id'    => $this->resource->id,
                'path'  => $this->resource->path,
                'size'  => $this->resource->size,
                'type'  => $this->resource->type,
            ]
        ];
    }
}
