<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductProperty
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $detail
 * @property int $product_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductProperty extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_properties';

    /**
     * @var array
     */
    protected $hidden = ['product_id', 'created_at', 'updated_at'];
}
