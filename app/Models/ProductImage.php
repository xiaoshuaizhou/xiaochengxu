<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 *
 * @package App\Models
 * @property int $id
 * @property int $img_id
 * @property int $order
 * @property int $product_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Images $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_images';

    /**
     * @var array
     */
    protected $hidden = ['id', 'img_id', 'product_id', 'created_at', 'updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Models\Images', 'img_id', 'id');
    }
}
