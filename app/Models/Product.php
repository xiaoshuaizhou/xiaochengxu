<?php

namespace App\Models;

/**
 * Class Product
 * @package App\Models
 */
class Product extends BaseModel
{
    /**
     * @var string
     */
    public $table = 'products';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function theme()
    {
        return $this->belongsToMany('App\Models\Theme', 'theme_products', 'product_id', 'theme_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Models\Images', 'img_id', 'id');
    }

    /**
     * 与 productImage 一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage','product_id', 'id');
    }

    /**
     * 与productProperty一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productProperty()
    {
        return $this->hasMany('App\Models\ProductProperty', 'product_id', 'id');
    }

}
