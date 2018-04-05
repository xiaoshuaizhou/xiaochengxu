<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductProperty extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
        'id' => $this->id,
        'name' => $this->name,
        'main_img_url' => $this->image->url,
        'summary' => $this->summary,
        'price' => $this->price,
        'stock' => $this->stock,
        'properties' => $this->productProperty,
        'imgs' => $this->productImages,
    ];
    }
}
