<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
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
