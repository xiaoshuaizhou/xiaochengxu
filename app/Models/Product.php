<?php

namespace App\Models;

/**
 * Class Product
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $stock
 * @property int $category_id
 * @property string $main_img_url
 * @property int $from
 * @property string $summary
 * @property int $img_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Images $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $productImages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductProperty[] $productProperty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Theme[] $theme
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMainImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
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
