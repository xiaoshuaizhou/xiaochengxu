<?php

namespace App\Models;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BannerItems[] $bannerItems
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $url
 */
class Banner extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'banners';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bannerItems()
    {
        return $this->hasMany('App\Models\BannerItems', 'banner_id', 'id');
    }
}
