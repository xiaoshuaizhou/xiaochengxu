<?php

namespace App\Http\Resources;

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
            'img_id' => $this->img_id,
            'key_word' => $this->key_word,
            'type' => $this->type,
            'img' => [
                'url' =>  $this->image->url,
                'form' => $this->image->from,
            ],
        ];
    }
}
