<?php

namespace App\Http\Resources;

use Faker\Provider\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'img_id' => $this->img_id,
            'key_word' => $this->key_word,
            'img' => ['url' => $this->image->url]
        ];
    }
}
