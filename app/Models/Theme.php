<?php

namespace App\Models;

/**
 * Class Theme
 * @package App\Models
 */
/**
 * Class Theme
 * @package App\Models
 */
class Theme extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'themes';

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topicImage()
    {
        return $this->belongsTo('App\Models\Images', 'topic_img_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function headImage()
    {
        return $this->belongsTo('App\Models\Images', 'head_img_id', 'id');
    }

    /**
     * product 多对多关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'theme_products', 'theme_id', 'product_id');
    }
}
