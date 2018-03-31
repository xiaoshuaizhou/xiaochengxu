<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @property-read string $url
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    /**
     * 定义访问器 可用于复用
     * @param $value
     * @return string
     */
    public function prefixImageUrl($value)
    {
        if ($this->from == 1) {
            return env('IMG_PREFIX') . $value;
        }

        return $value;
    }
}
