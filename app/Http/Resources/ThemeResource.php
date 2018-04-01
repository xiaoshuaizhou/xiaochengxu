<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'topic_img' => [
                'url' => $this->topicImage->url
            ],
            'hear_img' => [
                'url' => $this->headImage->url
            ],
            'product' => ProductResource::collection($this->products),
        ];
    }
}
