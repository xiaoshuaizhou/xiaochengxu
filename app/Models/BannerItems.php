<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BannerItems
 *
 * @property int $id
 * @property int $img_id
 * @property string $key_word
 * @property int $type
 * @property int $banner_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereBannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereKeyWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerItems whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BannerItems extends Model
{
    /**
     * @var string
     */
    protected $table = 'banner_items';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Models\Images', 'id', 'img_id');
    }
}
