<?php

namespace App\Models;

/**
 * Class Theme
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $topic_img_id
 * @property int $head_img_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Images $headImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \App\Models\Images $topicImage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereHeadImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereTopicImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereUpdatedAt($value)
 * @mixin \Eloquent
 */
/**
 * Class Theme
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $topic_img_id
 * @property int $head_img_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Images $headImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \App\Models\Images $topicImage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereHeadImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereTopicImgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Theme whereUpdatedAt($value)
 * @mixin \Eloquent
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
