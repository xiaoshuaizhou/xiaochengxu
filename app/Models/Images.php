<?php

namespace App\Models;

/**
 * App\Models\Images
 *
 * @property int $id
 * @property string $url
 * @property int $from
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Images whereUrl($value)
 * @mixin \Eloquent
 */
class Images extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'images';
    /**
     * @var array
     */
    protected $hidden = ['id', 'from' , 'created_at', 'updated_at'];

    /**
     * 重写父级的读取器，只用于image模型
     * @param $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        return $this->prefixImageUrl($value);
    }
}
