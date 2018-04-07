<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * @package App\Models
 */
class OrderProduct extends Model
{
    /**
     * @var string
     */
    protected $table = 'order_products';
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'count'];
}
