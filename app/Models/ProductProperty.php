<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductProperty
 * @package App\Models
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
